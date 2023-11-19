<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentTransactionsTable extends Migration
{
    public function up(): void
    {
        Schema::create('payment_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('payment_method');
            $table->string('payment_gateway');
            $table->string('payment_gateway_transaction_id');
            $table->string('payment_gateway_status');
            $table->string('payment_gateway_error')->nullable();
            $table->string('payment_gateway_error_code')->nullable();
            $table->string('payment_gateway_error_message')->nullable();
            $table->integer('amount');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payment_transactions');
    }
}