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
        Schema::create('latest_orders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('latest_wholesaler_id')->nullable()->constrained();
            $table->foreignUuid('latest_code_id')->nullable()->constrained();
            $table->foreignUuid('branch_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignUuid('brand_id')->nullable()->constrained();
            $table->decimal('value', 10, 2)->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('latest_orders');
    }
};
