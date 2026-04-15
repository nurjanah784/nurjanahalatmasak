<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with(['user', 'loan.item', 'paidBy'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        $totalUnpaid = Transaction::where('status', 'unpaid')->count();
        $totalPaid = Transaction::where('status', 'paid')->count();
        $totalPenalty = Transaction::where('status', 'paid')->sum('penalty_amount');
        
        return view('transactions', compact('transactions', 'totalUnpaid', 'totalPaid', 'totalPenalty'));
    }

    public function show($id)
    {
        $transaction = Transaction::with(['user', 'loan.item'])->findOrFail($id);
        
        $conditionText = $this->getConditionText($transaction->loan->condition ?? 'good');
        
        // Hitung total harga barang (harga x jumlah)
        $itemPrice = $transaction->loan && $transaction->loan->item ? $transaction->loan->item->price : 0;
        $totalPrice = $itemPrice * ($transaction->loan->amount ?? 0);
        
        return response()->json([
            'id' => $transaction->id,
            'transaction_code' => $transaction->transaction_code,
            'user_name' => $transaction->user ? $transaction->user->name : 'Tidak diketahui',
            'item_name' => $transaction->loan && $transaction->loan->item ? $transaction->loan->item->name : '-',
            'amount' => $transaction->loan ? $transaction->loan->amount : 0,
            'item_price' => $itemPrice,  // <-- TAMBAHKAN INI
            'total_price' => $transaction->total_price ?? $totalPrice,  // <-- TAMBAHKAN INI
            'condition_text' => $conditionText,
            'penalty_amount' => $transaction->penalty_amount,
            'payment_method' => $transaction->payment_method,
            'status' => $transaction->status,
            'created_at' => $transaction->created_at->format('d/m/Y H:i:s')
        ]);
    }

    public function pay(Request $request, $id)
    {
        $transaction = Transaction::findOrFail($id);
        
        if ($transaction->status === 'paid') {
            return response()->json(['success' => false, 'message' => 'Transaksi sudah lunas']);
        }
        
        $request->validate([
            'payment_method' => 'required|in:cash,transfer'
        ]);
        
        $transaction->update([
            'status' => 'paid',
            'payment_method' => $request->payment_method,
            'paid_at' => now(),
            'paid_by' => Auth::id()
        ]);
        
        if ($transaction->loan) {
            $transaction->loan->update([
                'payment_method' => $request->payment_method,
                'penalty_amount' => $transaction->penalty_amount
            ]);
        }
        
        Log::create([
            'user_id' => Auth::id(),
            'item_id' => $transaction->loan ? $transaction->loan->item_id : null,
            'amount' => $transaction->penalty_amount,
            'action' => 'payment',
            'description' => "Pembayaran denda untuk transaksi {$transaction->transaction_code} sebesar Rp " . number_format($transaction->penalty_amount, 0, ',', '.')
        ]);
        
        $receipt = $this->generateReceipt($transaction);
        
        return response()->json([
            'success' => true,
            'receipt' => $receipt,
            'message' => 'Pembayaran berhasil'
        ]);
    }

    public function receipt($id)
    {
        $transaction = Transaction::with(['user', 'loan.item', 'paidBy'])->findOrFail($id);
        $receipt = $this->generateReceipt($transaction);
        
        return response()->json(['receipt' => $receipt]);
    }

    private function generateReceipt($transaction)
    {
        $conditionText = $this->getConditionText($transaction->loan->condition ?? 'good');
        
        // Hitung total harga barang (harga x jumlah)
        $itemPrice = $transaction->loan && $transaction->loan->item ? $transaction->loan->item->price : 0;
        $totalPrice = $itemPrice * ($transaction->loan->amount ?? 0);
        $totalBayar = $totalPrice + $transaction->penalty_amount;
        
        return [
            'transaction_number' => $transaction->transaction_code,
            'date' => $transaction->paid_at 
                ? $transaction->paid_at->format('d/m/Y H:i') 
                : $transaction->created_at->format('d/m/Y H:i'),
            'officer' => $transaction->paidBy ? $transaction->paidBy->name : Auth::user()->name,
            'borrower' => $transaction->user ? $transaction->user->name : 'Tidak diketahui',
            'item_name' => $transaction->loan && $transaction->loan->item ? $transaction->loan->item->name : '-',
            'amount' => $transaction->loan ? $transaction->loan->amount : 0,
            'item_price' => $itemPrice,  // <-- TAMBAHKAN INI
            'total_price' => $totalPrice,  // <-- TAMBAHKAN INI
            'condition_text' => $conditionText,
            'penalty' => $transaction->penalty_amount,
            'total_bayar' => $totalBayar,  // <-- TAMBAHKAN INI
            'payment_method' => $transaction->payment_method ?? '-'
        ];
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
}