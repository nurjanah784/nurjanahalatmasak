<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Update loan yang return_due_date NULL dan statusnya borrowed
        DB::table('loans')
            ->whereNull('return_due_date')
            ->where('status', 'borrowed')
            ->update([
                'return_due_date' => DB::raw('DATE_ADD(borrow_date, INTERVAL 7 DAY)')
            ]);
        
        // Untuk loan yang sudah dikembalikan (returned) tapi return_due_date NULL
        // bisa diisi dengan borrow_date + 7 hari juga
        DB::table('loans')
            ->whereNull('return_due_date')
            ->where('status', 'returned')
            ->update([
                'return_due_date' => DB::raw('DATE_ADD(borrow_date, INTERVAL 7 DAY)')
            ]);
    }

    public function down()
    {
        // Rollback: kembalikan ke NULL (opsional)
        DB::table('loans')->update(['return_due_date' => null]);
    }
};