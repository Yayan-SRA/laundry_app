<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Role;
use App\Models\Type;
use App\Models\Unit;
use App\Models\User;
use App\Models\Price;
use App\Models\Store;
use App\Models\Cashier;
use App\Models\Finance;
use App\Models\Product;
use App\Models\Service;
use App\Models\Customer;
use App\Models\Duration;
use App\Models\Expenditure;
use App\Models\Transaction;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Store::create([
            // 'id' => mt_rand(1000000, 9999999),
            'name' => 'D Kus Laundry',
            'address' => 'Jl. Kiarapayung, Kiarapayung, Kec. Klari, Karawang, Jawa Barat 41371',
        ]);
        Store::create([
            // 'id' => mt_rand(1000000, 9999999),
            'name' => 'D Kus Laundry Cabang 2',
            'address' => 'Jl. Surotani, Gianyar, Kec. Kemp, Karaw, JawaBar 446371',
        ]);

        Role::create([
            // 'id' => mt_rand(1000000000, 9999999999),
            'name' => 'Super Admin',
        ]);

        Role::create([
            // 'id' => mt_rand(1000000000, 9999999999),
            'name' => 'Admin',
        ]);

        User::create([
            // 'id' => mt_rand(1000000, 9999999),
            'store_id' => 1,
            'role_id' => 1,
            'name' => 'Sofyan Rizki Afandy',
            'password' => bcrypt('123456'),
        ]);

        Customer::factory(2)->create();

        Type::create([
            'name' => 'Kiloan'
        ]);
        Type::create([
            'name' => 'Satuan'
        ]);

        Product::create([
            'type_id' => 1,
            'name' => 'Pakaian'
        ]);
        Product::create([
            'type_id' => 2,
            'name' => 'Spray'
        ]);
        Product::create([
            'type_id' => 2,
            'name' => 'Selimut'
        ]);
        Product::create([
            'type_id' => 2,
            'name' => 'Karpet'
        ]);

        Service::create([
            'type_id' => 1,
            'name' => 'Cuci Kering'
        ]);
        Service::create([
            'type_id' => 1,
            'name' => 'Cuci Kering + Setrika'
        ]);
        Service::create([
            'type_id' => 2,
            'name' => 'Setrika'
        ]);
        Service::create([
            'type_id' => 1,
            'name' => 'Cuci Basah'
        ]);

        Unit::create([
            'name' => 'Kg'
        ]);

        Unit::create([
            'name' => 'Pcs'
        ]);

        Unit::create([
            'name' => 'Jam'
        ]);
        Unit::create([
            'name' => 'Hari'
        ]);

        Duration::create([
            'type_id' => 1,
            'time_period' => 2,
            'unit_id' => 3,
        ]);
        Duration::create([
            'type_id' => 2,
            'time_period' => 2,
            'unit_id' => 4,
        ]);


        Price::create([
            'type_id' => 2,
            'product_id' => 3,
            'service_id' => 3,
            'duration_id' => 2,
            'price' => 7000,
        ]);
        Price::create([
            'type_id' => 1,
            'product_id' => 1,
            'service_id' => 2,
            'duration_id' => 1,
            'price' => 5000,
        ]);

        // Transaction::create([
        //     'id' => mt_rand(1000000, 9999999),
        //     'key' => 'INV' . mt_rand(10000, 999999),
        //     'user_id' => 1,
        //     'customer_id' => 1,
        //     'product_id' => 1,
        //     'service_id' => 1,
        //     'duration_id' => 4,
        //     'price' => 5000,
        //     'weight' => 2,
        //     'total_price' => 10000,
        //     'date_complete' => '2023-05-23',
        // ]);

        // Cashier::create([
        //     'id' => mt_rand(1000000, 9999999),
        //     'key' => 'INV' . mt_rand(10000, 999999),
        //     'user_id' => 1,
        //     'transaction_id' => 1,
        //     'customer_money' => 20000,
        //     'change' => 10000,
        //     'income' => 10000,
        // ]);

        // Expenditure::create([
        //     'user_id' => 1,
        //     'name' => 'Plastik',
        //     'price' => 2000,
        //     'quantity' => 2,
        //     'total' => 4000,
        // ]);

        // Finance::create([
        //     'store_id' => 1,
        //     'gross_profit' => 10000,
        //     'expenditure' => 4000,
        //     'net_profit' => 6000,
        // ]);
    }
}
