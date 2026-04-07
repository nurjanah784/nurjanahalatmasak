<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Loan;
use App\Models\Log;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoanController extends Controller
{
    public function loans($userId = null)
    {
        // Jika admin atau petugas, tampilkan semua peminjaman
        if (in_array(Auth::user()->role, ['admin', 'petugas'])) {
            $loans = Loan::with(['item', 'user', 'transaction'])->orderBy('created_at', 'desc')->get();
            $items = Item::all();
        } else {
            // Jika user biasa, hanya tampilkan peminjaman miliknya sendiri
            $userId = $userId ?? Auth::id();
            $loans = Loan::with(['item', 'user', 'transaction'])->where('user_id', $userId)->orderBy('created_at', 'desc')->get();
            $items = Item::all();
        }
        
        return view('pinjamBarang', compact('items', 'loans'));
    }

    public function borrow(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'user' => 'required|string',
            'borrow_date' => 'required|date',
            'description' => 'required|string',
            'amount' => 'required|integer|min:1|max:' . Item::find($request->item_id)->stock,
        ]);

        $item = Item::findOrFail($request->item_id);

        if ($item->stock < $request->amount) {
            return back()->with('error', 'Stok barang tidak mencukupi');
        }

        $item->decrement('stock', $request->amount);

        $loan = Loan::create([
            'user_id' => Auth::id(),
            'item_id' => $item->id,
            'borrow_date' => $request->borrow_date,
            'description' => $request->description,
            'amount' => $request->amount,
            'status' => 'borrowed',
        ]);

        Log::create([
            'user_id' => Auth::id(),
            'item_id' => $item->id,
            'action' => 'borrow',
            'amount' => $request->amount,
            'description' => "Meminjam {$request->amount} unit {$item->name}"
        ]);

        if ($request->ajax()) {
        return response()->json([
            'success' => true, 
            'message' => 'Berhasil meminjam barang!'
        ]);
    }
    
    return back()->with('success', 'Peminjaman berhasil!');
}

    public function return(Request $request, Loan $loan)
    {
        if (!$loan) {
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => 'Peminjaman tidak ditemukan.']);
            }
            return back()->with('error', 'Peminjaman tidak ditemukan.');
        }

        if ($loan->status === 'returned') {
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => 'Barang sudah dikembalikan']);
            }
            return back()->with('error', 'Barang sudah dikembalikan');
        }

        $item = $loan->item;
        if (!$item) {
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => 'Barang yang dipinjam tidak ditemukan.']);
            }
            return back()->with('error', 'Barang yang dipinjam tidak ditemukan.');
        }

        $request->validate([
            'condition' => 'required|in:good,light_damage,heavy_damage,lost',
        ]);

        $condition = $request->condition;
        $penalty = 0;
        $itemPrice = $item->price ?? 100000;
        
        switch($condition) {
            case 'light_damage':
                $penalty = 50000;
                break;
            case 'heavy_damage':
                $penalty = 150000;
                break;
            case 'lost':
                $penalty = $itemPrice * 2;
                break;
            case 'good':
                $penalty = 0;
                break;
        }

        $loan->status = 'returned';
        $loan->return_date = now();
        $loan->condition = $condition;
        $loan->penalty_amount = $penalty;
        
        if ($penalty > 0) {
            $request->validate([
                'payment_method' => 'required|in:cash,transfer'
            ]);
            $loan->payment_method = $request->payment_method;
        }
        
        $loan->save();

        if ($condition !== 'lost') {
            $item->increment('stock', $loan->amount);
        }

        $transaction = null;
        if ($penalty > 0) {
            $transaction = Transaction::create([
                'transaction_code' => 'TRX-' . strtoupper(uniqid()),
                'loan_id' => $loan->id,
                'user_id' => $loan->user_id,
                'penalty_amount' => $penalty,
                'payment_method' => $request->payment_method,
                'status' => 'unpaid'
            ]);
            
            $loan->transaction_id = $transaction->id;
            $loan->save();
        }

        $conditionText = $this->getConditionText($condition);
        $logDescription = "Mengembalikan {$loan->amount} unit {$item->name} dengan kondisi: {$conditionText}";
        if ($penalty > 0) {
            $logDescription .= " (Denda: Rp " . number_format($penalty, 0, ',', '.') . ")";
        }
        
        Log::create([
            'user_id' => Auth::id(),
            'item_id' => $item->id,
            'amount' => $loan->amount,
            'action' => 'return',
            'description' => $logDescription
        ]);

        if ($request->ajax()) {
            $receipt = null;
            if ($penalty > 0 && $transaction) {
                $user = \App\Models\User::find($loan->user_id);
                $receipt = [
                    'transaction_number' => $transaction->transaction_code,
                    'date' => now()->format('d/m/Y H:i'),
                    'officer' => Auth::user()->name,
                    'borrower' => $user ? $user->name : 'Tidak diketahui',
                    'item_name' => $item->name,
                    'amount' => $loan->amount,
                    'condition_text' => $conditionText,
                    'penalty' => $penalty,
                    'payment_method' => $request->payment_method
                ];
            }
            return response()->json([
                'success' => true, 
                'receipt' => $receipt, 
                'has_penalty' => $penalty > 0,
                'message' => $penalty > 0 ? "Barang dikembalikan dengan denda Rp " . number_format($penalty, 0, ',', '.') : "Barang berhasil dikembalikan"
            ]);
        }

        if ($penalty > 0) {
            return redirect()->route('transactions')->with('warning', "Barang berhasil dikembalikan. Terdapat denda sebesar Rp " . number_format($penalty, 0, ',', '.') . ". Silakan lakukan pembayaran.");
        }

        return back()->with('success', 'Barang berhasil dikembalikan');
    }

    private function getConditionText($condition)
    {
        return match($condition) {
            'good' => 'Baik',
            'light_damage' => 'Rusak Ringan',
            'heavy_damage' => 'Rusak Berat',
            'lost' => 'Hilang',
            default => 'Tidak diketahui'
        };
    }

    public function destroy($id)
    {
        try {
            $loan = Loan::findOrFail($id);
            
            // Cek apakah peminjaman sudah dikembalikan
            if ($loan->status !== 'returned') {
                return response()->json([
                    'success' => false,
                    'message' => 'Hanya peminjaman yang sudah dikembalikan yang dapat dihapus'
                ], 400);
            }
            
            // Kembalikan stok barang (kecuali hilang)
            if ($loan->condition !== 'lost') {
                $loan->item->increment('stock', $loan->amount);
            }
            
            // Hapus transaksi terkait jika ada
            if ($loan->transaction) {
                $loan->transaction->delete();
            }
            
            // Hapus log terkait
            Log::where('item_id', $loan->item_id)
                ->where('amount', $loan->amount)
                ->where('action', 'return')
                ->delete();
            
            $loan->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Data peminjaman berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getDetail($id)
    {
        $loan = Loan::with('item', 'user')->findOrFail($id);
        
        $conditionText = '';
        if ($loan->condition) {
            $conditionText = match($loan->condition) {
                'good' => 'Baik',
                'light_damage' => 'Rusak Ringan',
                'heavy_damage' => 'Rusak Berat',
                'lost' => 'Hilang',
                default => 'Tidak diketahui'
            };
        }
        
        return response()->json([
            'item_name' => $loan->item->name,
            'borrower_name' => $loan->user ? $loan->user->name : 'Tidak diketahui',
            'amount' => $loan->amount,
            'status' => $loan->status,
            'borrow_date' => $loan->borrow_date ? \Carbon\Carbon::parse($loan->borrow_date)->format('d/m/Y') : '-',
            'return_due_date' => $loan->return_due_date ? \Carbon\Carbon::parse($loan->return_due_date)->format('d/m/Y') : '-',
            'return_date' => $loan->return_date ? \Carbon\Carbon::parse($loan->return_date)->format('d/m/Y') : 'Belum',
            'description' => $loan->description ?? '-',
            'penalty_amount' => $loan->penalty_amount ?? 0,
            'condition' => $loan->condition,
            'condition_text' => $conditionText
        ]);
    }
}