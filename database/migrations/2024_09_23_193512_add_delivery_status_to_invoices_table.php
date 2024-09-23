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
            $table->enum('delivery_status', ['PENDING', 'CONFIRMED', 'ON_THE_WAY', 'DELIVERED'])
                ->default('PENDING')
                ->after('serial_number'); // Adjust the placement as needed
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropColumn('delivery_status');
        });
    }
};
