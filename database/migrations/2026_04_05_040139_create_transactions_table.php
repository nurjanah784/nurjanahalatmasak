<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_code')->unique();
            $table->foreignId('loan_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->bigInteger('penalty_amount')->default(0);
            $table->enum('payment_method', ['cash', 'transfer'])->nullable();
            $table->enum('status', ['unpaid', 'paid'])->default('unpaid');
            $table->timestamp('paid_at')->nullable();
            $table->foreignId('paid_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });

        // Tambahkan kolom ke tabel loans
        Schema::table('loans', function (Blueprint $table) {
            $table->enum('condition', ['good', 'light_damage', 'heavy_damage', 'lost'])->nullable()->after('status');
            $table->bigInteger('penalty_amount')->default(0)->after('condition');
            $table->enum('payment_method', ['cash', 'transfer'])->nullable()->after('penalty_amount');
            $table->foreignId('transaction_id')->nullable()->constrained()->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('loans', function (Blueprint $table) {
            $table->dropForeign(['transaction_id']);
            $table->dropColumn(['condition', 'penalty_amount', 'payment_method', 'transaction_id']);
        });
        Schema::dropIfExists('transactions');
    }
};