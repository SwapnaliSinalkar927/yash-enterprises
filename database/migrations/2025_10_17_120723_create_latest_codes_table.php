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
        Schema::create('latest_codes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('code')->unique();
            $table->decimal('value', 10, 2);
            $table->foreignUuid('latest_wd_id')->nullable()->constrained();
            $table->foreignUuid('brand_id')->nullable()->constrained();
            $table->foreignUuid('branch_id')->nullable()->constrained()->cascadeOnDelete();
            $table->boolean('is_used')->default(0);
            $table->unsignedInteger('batch')->default(1);
            $table->string('denomination')->nullable();
            $table->boolean('status')->default(1);
            $table->timestamp('used_at')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('latest_codes');
    }
};
