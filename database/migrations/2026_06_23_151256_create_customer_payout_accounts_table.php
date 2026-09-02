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
        Schema::create('customer_payout_accounts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('pay_id');
            $table->string('customer_name');
            $table->string('customer_mobile', 20);
            $table->string('customer_email')->nullable();

            // Razorpay Contact
            $table->string('contact_id')->unique();

            // Razorpay Fund Account
            $table->string('fund_account_id')->unique();
            $table->string('vpa_address');

            $table->enum('account_type', ['vpa'])->default('vpa');

            $table->boolean('is_active')->default(true);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_payout_accounts');
    }
};
