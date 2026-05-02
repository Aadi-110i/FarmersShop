<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create a Supplier
        $supplier = User::create([
            'name' => 'Green Valley Supplies',
            'email' => 'supplier@example.com',
            'password' => Hash::make('password'),
            'role' => 'supplier',
        ]);

        // Create a Farmer
        User::create([
            'name' => 'Farmer John',
            'email' => 'farmer@example.com',
            'password' => Hash::make('password'),
            'role' => 'farmer',
        ]);

        // Add Products
        Product::create([
            'user_id' => $supplier->id,
            'name' => 'Organic Wheat Seeds',
            'category' => 'seeds',
            'description' => 'High-yield, drought-resistant organic wheat seeds perfect for the spring season.',
            'price' => 45.00,
            'stock_quantity' => 100,
        ]);

        Product::create([
            'user_id' => $supplier->id,
            'name' => 'Premium Nitrogen Fertilizer',
            'category' => 'fertilizers',
            'description' => 'Eco-friendly nitrogen-rich fertilizer to boost your crop growth significantly.',
            'price' => 85.50,
            'stock_quantity' => 50,
        ]);

        Product::create([
            'user_id' => $supplier->id,
            'name' => 'Professional Hand Tiller',
            'category' => 'tools',
            'description' => 'Durable steel hand tiller for easy soil preparation in smaller plots.',
            'price' => 29.99,
            'stock_quantity' => 25,
        ]);

        Product::create([
            'user_id' => $supplier->id,
            'name' => 'Hybrid Tomato Seeds',
            'category' => 'seeds',
            'description' => 'Fast-growing hybrid tomato seeds with high resistance to common pests.',
            'price' => 12.00,
            'stock_quantity' => 200,
        ]);
    }
}
