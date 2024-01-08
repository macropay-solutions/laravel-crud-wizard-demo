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
        Schema::create('clients', function (Blueprint $table): void {
            $table->id();
            $table->string('name')->index();
            $table->boolean('active')->default(false)->index();
            $table->dateTime('created_at')->index();
            $table->dateTime('updated_at')->nullable();
        });
        Schema::create('operations', function (Blueprint $table): void {
            $table->id();
            $table->unsignedBigInteger('parent_id')->nullable()->index();
            $table->unsignedBigInteger('client_id')->index();
            $table->string('currency', 3)->index();
            $table->decimal('value', 10)->unsigned()->index();
            $table->dateTime('created_at')->index();
            $table->dateTime('updated_at')->nullable();
        });
        Schema::create('operations_products_pivot', function (Blueprint $table): void {
            $table->unsignedBigInteger('operation_id');
            $table->unsignedBigInteger('product_id');
            $table->dateTime('created_at');
            $table->primary(['operation_id', 'product_id']);
            $table->index(['product_id', 'operation_id'], 'composed');
        });
        Schema::create('products', function (Blueprint $table): void {
            $table->id();
            $table->string('ean')->index();
            $table->string('name')->index();
            $table->string('code')->index();
            $table->string('currency', 3)->index();
            $table->decimal('value', 10)->unsigned()->index();
            $table->dateTime('created_at')->index();
            $table->dateTime('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
        Schema::dropIfExists('operations');
        Schema::dropIfExists('products');
        Schema::dropIfExists('operations_products_pivot');
    }
};
