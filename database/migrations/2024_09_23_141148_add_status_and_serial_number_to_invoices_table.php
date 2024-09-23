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
        Schema::table('invoices', function (Blueprint $table) {
            // Add the status column
            $table->enum('status', ['PAID', 'UNPAID'])->default('UNPAID')->after('amount'); // Adjust the position as needed

            // Add the serial_number column
            $table->string('serial_number')->nullable(); // Adjust the position as needed
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('invoices', function (Blueprint $table) {
            // Remove the columns in the reverse order
            $table->dropColumn('serial_number');
            $table->dropColumn('status');
        });
    }
};
