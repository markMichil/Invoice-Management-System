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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Foreign key to customers
            $table->foreignId('customer_id')->constrained()->onDelete('cascade'); // Foreign key to customers
            $table->decimal('amount', 10, 2);
            $table->date('invoice_date');
            $table->text('description')->nullable();
            $table->softDeletes(); // Adds deleted_at field for soft delete
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
