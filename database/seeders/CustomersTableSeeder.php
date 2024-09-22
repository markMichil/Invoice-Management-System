<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Customer;
class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Customer::create([
            'name' => 'John Doe',
            'phone' => '1234567890',
            'email' => 'john@example.com',
            'invoice_count' => 0
        ]);

        Customer::create([
            'name' => 'Jane Smith',
            'phone' => '0987654321',
            'email' => 'jane@example.com',
            'invoice_count' => 0
        ]);
    }
}
