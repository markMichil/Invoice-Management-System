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
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->string('action'); // e.g., create, update, delete
            $table->foreignId('invoice_id')->constrained()->onDelete('cascade'); // Related invoice
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // The user who performed the action
            $table->enum('user_role',['ADMIN','EMPLoYEE']); // e.g., ADMIN, EMPLOYEE
            $table->timestamps(); // Will automatically store action timestamp
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logs');
    }
};
