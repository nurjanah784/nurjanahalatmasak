<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
// Di file migration yang baru dibuat:
public function up()
{ 
    Schema::table('transactions', function (Blueprint $table) {
        $table->decimal('amount_paid', 15, 0)->nullable()->after('penalty_amount');
        $table->decimal('change_amount', 15, 0)->nullable()->after('amount_paid');
    });
}

public function down()
{
    Schema::table('transactions', function (Blueprint $table) {
        $table->dropColumn(['amount_paid', 'change_amount']);
    });
}
};
