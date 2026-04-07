<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('loans', function (Blueprint $table) {
            if (!Schema::hasColumn('loans', 'return_due_date')) {
                $table->date('return_due_date')->nullable()->after('borrow_date');
            }
        });
    }

    public function down()
    {
        Schema::table('loans', function (Blueprint $table) {
            $table->dropColumn('return_due_date');
        });
    }
};