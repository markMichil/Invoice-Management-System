<?php

namespace Database\Seeders;

use App\Models\Invoice;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InvoicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Invoice::create([
            'user_id' => 1,
            'customer_id' => 1,
            'amount' => 150.00,
            'invoice_date' => '2024-09-01',
            'description' => 'Website development services'
        ]);

        Invoice::create([
            'user_id' => 1,
            'customer_id' => 2,
            'amount' => 200.00,
            'invoice_date' => '2024-09-05',
            'description' => 'Graphic design services'
        ]);
    }
}
