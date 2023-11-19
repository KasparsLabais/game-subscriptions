<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionPurchasesTable extends Migration
{
    public function up(): void
    {
        Schema::create('subscription_purchases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subscription_package_id')->constrained('subscription_packages');
            $table->foreignId('user_id')->constrained('users');
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->boolean('active')->default(false);
            $table->boolean('cancelled')->default(false);
            $table->timestamp('cancelled_at')->nullable();
            $table->foreignId('payment_transaction_id')->nullable()->constrained('payment_transactions');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subscription_purchases');
    }
}