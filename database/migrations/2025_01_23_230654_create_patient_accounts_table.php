<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('patient_accounts', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->foreignId('invoice_id')->nullable()->references('id')->on('invoices')->onDelete('cascade');
            $table->foreignId('receipt_account_id')->nullable()->references('id')->on('receipt_accounts')->onDelete('cascade');
            $table->foreignId('payment_account_id')->nullable()->references('id')->on('payment_accounts')->onDelete('cascade');
            $table->foreignId('patient_id')->references('id')->on('patients')->onDelete('cascade');
            $table->decimal('debit' , 8 , 2)->nullable();
            $table->decimal('credit' , 8 , 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_accounts');
    }
};
