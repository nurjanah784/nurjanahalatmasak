<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogController extends Controller
{
    public function index()
    {
        // Check if the user is an admin
        if (Auth::user()->role === 'admin') {
            // If user is admin, show all logs
            $logs = Log::all();
        } else {
            // If user is not admin, show only logs related to the logged-in user
            $logs = Log::where('user_id', Auth::id())->get();
        }
    
        return view('log', compact('logs'));
    }

    public function destroy($logId)
    {
        try {
            // Find log by ID
            $log = Log::findOrFail($logId);

            // Delete log
            $log->delete();

            return back()->with('success', 'Log berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat menghapus Log.');
        }
    }
}