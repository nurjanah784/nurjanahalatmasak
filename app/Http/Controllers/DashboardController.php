<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Pastikan user sudah login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        $userRole = $user->role;
        
        // AMBIL DATA ITEMS UNTUK SEMUA USER
        $items = Item::all();
        
        // Hitung statistik berdasarkan role
        if ($userRole === 'admin' || $userRole === 'petugas') {
            // Admin & Petugas: lihat semua peminjaman
            $borrowItems = Loan::where('status', 'borrowed')->count();
            $returnItems = Loan::where('status', 'returned')->count();
            
            // Data untuk grafik mingguan (SEMUA peminjaman)
            $weeklyBorrowData = $this->getWeeklyBorrowData();
            $weeklyReturnData = $this->getWeeklyReturnData();
        } else {
            // User: hanya lihat peminjaman sendiri
            $borrowItems = Loan::where('user_id', $user->id)
                               ->where('status', 'borrowed')
                               ->count();
            $returnItems = Loan::where('user_id', $user->id)
                               ->where('status', 'returned')
                               ->count();
            
            // Data untuk grafik mingguan (hanya user bersangkutan)
            $weeklyBorrowData = $this->getWeeklyBorrowData($user->id);
            $weeklyReturnData = $this->getWeeklyReturnData($user->id);
        }

        // KIRIM KE VIEW
        return view('dashboard', [
            'userRole' => $userRole,
            'items' => $items,
            'borrowItems' => $borrowItems,
            'returnItems' => $returnItems,
            'weeklyBorrowData' => $weeklyBorrowData,
            'weeklyReturnData' => $weeklyReturnData
        ]);
    }

    /**
     * Ambil data peminjaman per minggu (4 minggu terakhir)
     */
    private function getWeeklyBorrowData($userId = null)
    {
        $data = [];
        $weeks = [];
        
        // 4 minggu terakhir
        for ($i = 3; $i >= 0; $i--) {
            $startOfWeek = Carbon::now()->subWeeks($i)->startOfWeek();
            $endOfWeek = Carbon::now()->subWeeks($i)->endOfWeek();
            
            $weekLabel = 'Minggu ' . (4 - $i) . "\n(" . $startOfWeek->format('d/m') . " - " . $endOfWeek->format('d/m') . ")";
            $weeks[] = $weekLabel;
            
            $query = Loan::whereBetween('borrow_date', [$startOfWeek, $endOfWeek])
                         ->where('status', 'borrowed');
            
            if ($userId) {
                $query->where('user_id', $userId);
            }
            
            $data[] = $query->sum('amount');
        }
        
        return [
            'labels' => $weeks,
            'values' => $data,
            'total' => array_sum($data)
        ];
    }

    /**
     * Ambil data pengembalian per minggu (4 minggu terakhir)
     */
    private function getWeeklyReturnData($userId = null)
    {
        $data = [];
        $weeks = [];
        
        // 4 minggu terakhir
        for ($i = 3; $i >= 0; $i--) {
            $startOfWeek = Carbon::now()->subWeeks($i)->startOfWeek();
            $endOfWeek = Carbon::now()->subWeeks($i)->endOfWeek();
            
            $weekLabel = 'Minggu ' . (4 - $i) . "\n(" . $startOfWeek->format('d/m') . " - " . $endOfWeek->format('d/m') . ")";
            $weeks[] = $weekLabel;
            
            $query = Loan::whereBetween('return_date', [$startOfWeek, $endOfWeek])
                         ->where('status', 'returned');
            
            if ($userId) {
                $query->where('user_id', $userId);
            }
            
            $data[] = $query->sum('amount');
        }
        
        return [
            'labels' => $weeks,
            'values' => $data,
            'total' => array_sum($data)
        ];
    }
}