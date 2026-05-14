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
        $supplier = User::create([
            'name' => 'Bharat Agri Supplies',
            'email' => 'supplier@example.com',
            'password' => Hash::make('password'),
            'role' => 'supplier',
        ]);

        User::create([
            'name' => 'Kisan Kumar',
            'email' => 'farmer@example.com',
            'password' => Hash::make('password'),
            'role' => 'farmer',
        ]);

        // Map product file names to local image paths
        $localBase = '/images/products/';

        $products = [
            // SEEDS (10) — first 6 use AI-generated local images
            ['name' => 'Hybrid Basmati Grains', 'cat' => 'seeds', 'price' => 1250, 'desc' => 'Long-grain high-aroma rice grains for sowing.', 'img' => $localBase . 'seed_basmati.png'],
            ['name' => 'Golden Wheat Grains', 'cat' => 'seeds', 'price' => 850, 'desc' => 'Premium hard wheat seeds for high yield.', 'img' => $localBase . 'seed_wheat.png'],
            ['name' => 'Pure Cotton Pod Seeds', 'cat' => 'seeds', 'price' => 1400, 'desc' => 'Verified cotton seeds with high pest resistance.', 'img' => $localBase . 'seed_cotton.png'],
            ['name' => 'Yellow Mustard Seeds', 'cat' => 'seeds', 'price' => 450, 'desc' => 'High oil content traditional mustard.', 'img' => $localBase . 'seed_mustard.png'],
            ['name' => 'Sweet Corn Kernels', 'cat' => 'seeds', 'price' => 950, 'desc' => 'Fast growing golden maize seeds.', 'img' => $localBase . 'seed_corn.png'],
            ['name' => 'Hybrid Tomato Seeds', 'cat' => 'seeds', 'price' => 600, 'desc' => 'F1 hybrid seeds for disease-free tomatoes.', 'img' => $localBase . 'seed_tomato.png'],
            ['name' => 'Teja Chilli Seeds', 'cat' => 'seeds', 'price' => 1100, 'desc' => 'Hot spicy variety for commercial farming.', 'img' => 'https://images.unsplash.com/photo-1583607515847-21017362030a?q=80&w=800&auto=format&fit=crop'],
            ['name' => 'Soybean Seeds', 'cat' => 'seeds', 'price' => 1500, 'desc' => 'Certified high-germination soybean seeds.', 'img' => 'https://images.unsplash.com/photo-1550989460-0adf9ea622e2?q=80&w=800&auto=format&fit=crop'],
            ['name' => 'Red Onion Seeds', 'cat' => 'seeds', 'price' => 800, 'desc' => 'Quality Nasik Red onion seeds.', 'img' => 'https://images.unsplash.com/photo-1508747703725-7197771375a0?q=80&w=800&auto=format&fit=crop'],
            ['name' => 'Sunflower Seeds', 'cat' => 'seeds', 'price' => 1200, 'desc' => 'Premium seeds for oil-rich sunflowers.', 'img' => 'https://images.unsplash.com/photo-1470137430626-983a37b8ea46?q=80&w=800&auto=format&fit=crop'],

            // MANURES (5)
            ['name' => 'Pure Cow Dung Manure', 'cat' => 'manures', 'price' => 350, 'desc' => 'Decomposed organic cow dung for soil richness.', 'img' => 'https://images.unsplash.com/photo-1416879595882-3373a0480b5b?q=80&w=800&auto=format&fit=crop'],
            ['name' => 'Organic Vermicompost', 'cat' => 'manures', 'price' => 480, 'desc' => 'Earthworm processed high-nutrient compost.', 'img' => 'https://images.unsplash.com/photo-1464226184884-fa280b87c399?q=80&w=800&auto=format&fit=crop'],
            ['name' => 'Chicken Litter Manure', 'cat' => 'manures', 'price' => 420, 'desc' => 'High nitrogen organic manure for leafy crops.', 'img' => 'https://images.unsplash.com/photo-1500382017468-9049fed747ef?q=80&w=800&auto=format&fit=crop'],
            ['name' => 'Green Leaf Manure', 'cat' => 'manures', 'price' => 300, 'desc' => 'Crushed green biomass for natural mulching.', 'img' => 'https://images.unsplash.com/photo-1518531933037-91b2f5f229cc?q=80&w=800&auto=format&fit=crop'],
            ['name' => 'Bio-Slurry Compost', 'cat' => 'manures', 'price' => 550, 'desc' => 'Liquid organic slurry for quick nutrient absorption.', 'img' => 'https://images.unsplash.com/photo-1530836369250-ef72a3f5cda8?q=80&w=800&auto=format&fit=crop'],

            // FERTILIZERS (8)
            ['name' => 'Premium White Urea', 'cat' => 'fertilizers', 'price' => 266, 'desc' => '46% Nitrogen for rapid vegetative growth.', 'img' => 'https://images.unsplash.com/photo-1628352081506-83c43123ed6d?q=80&w=800&auto=format&fit=crop'],
            ['name' => 'DAP (18-46-0)', 'cat' => 'fertilizers', 'price' => 1350, 'desc' => 'Granular fertilizer for strong root establishment.', 'img' => 'https://images.unsplash.com/photo-1625246333195-78d9c38ad449?q=80&w=800&auto=format&fit=crop'],
            ['name' => 'NPK 19:19:19', 'cat' => 'fertilizers', 'price' => 1100, 'desc' => '100% water soluble balanced plant food.', 'img' => 'https://images.unsplash.com/photo-1592982537447-6f2a6a0c7c18?q=80&w=800&auto=format&fit=crop'],
            ['name' => 'Potash (MOP)', 'cat' => 'fertilizers', 'price' => 1700, 'desc' => 'Potassium supplement for grain weight and shine.', 'img' => 'https://images.unsplash.com/photo-1622383563227-04401ab4e5ea?q=80&w=800&auto=format&fit=crop'],
            ['name' => 'Zinc Sulphate', 'cat' => 'fertilizers', 'price' => 850, 'desc' => 'Prevents Khaira disease and yellowing.', 'img' => 'https://images.unsplash.com/photo-1584017911766-d451b3d0e843?q=80&w=800&auto=format&fit=crop'],
            ['name' => 'Liquid Zinc Boost', 'cat' => 'fertilizers', 'price' => 600, 'desc' => 'Chelated zinc for foliar spray application.', 'img' => 'https://images.unsplash.com/photo-1586771107445-d3ca888129ff?q=80&w=800&auto=format&fit=crop'],
            ['name' => 'Bio-Potash Liquid', 'cat' => 'fertilizers', 'price' => 500, 'desc' => 'Organic potassium mobilizer for fruits.', 'img' => 'https://images.unsplash.com/photo-1563514227147-6d2ff665a6a0?q=80&w=800&auto=format&fit=crop'],
            ['name' => 'Soil Sulfur Powder', 'cat' => 'fertilizers', 'price' => 750, 'desc' => 'Elemental sulfur for oilseed crop improvement.', 'img' => 'https://images.unsplash.com/photo-1530507629858-e4977d30e9e0?q=80&w=800&auto=format&fit=crop'],

            // TOOLS (7)
            ['name' => 'Hardened Steel Spade', 'cat' => 'tools', 'price' => 450, 'desc' => 'Heavy duty digging tool for Indian soils.', 'img' => 'https://images.unsplash.com/photo-1589923188900-85dae523342b?q=80&w=800&auto=format&fit=crop'],
            ['name' => 'Manual Row Seeder', 'cat' => 'tools', 'price' => 3500, 'desc' => 'Precise manual tool for uniform seed sowing.', 'img' => 'https://images.unsplash.com/photo-1523348837708-15d4a09cfac2?q=80&w=800&auto=format&fit=crop'],
            ['name' => '16L Knapsack Sprayer', 'cat' => 'tools', 'price' => 2200, 'desc' => 'Durable backpack sprayer for crop protection.', 'img' => 'https://images.unsplash.com/photo-1590682680695-43b964a3ae17?q=80&w=800&auto=format&fit=crop'],
            ['name' => 'Iron Garden Rake', 'cat' => 'tools', 'price' => 350, 'desc' => '12-tooth strong rake for field leveling.', 'img' => 'https://images.unsplash.com/photo-1592419044706-39796d40f98c?q=80&w=800&auto=format&fit=crop'],
            ['name' => 'Heavy Ground Pickaxe', 'cat' => 'tools', 'price' => 750, 'desc' => 'Double-headed pickaxe for hard rocky soil.', 'img' => 'https://images.unsplash.com/photo-1558905619-17254261be64?q=80&w=800&auto=format&fit=crop'],
            ['name' => 'Harvesting Sickle', 'cat' => 'tools', 'price' => 180, 'desc' => 'Sharp high-carbon steel harvesting blade.', 'img' => 'https://images.unsplash.com/photo-1589923188651-268a9765e432?q=80&w=800&auto=format&fit=crop'],
            ['name' => 'Digital PH Monitor', 'cat' => 'tools', 'price' => 1200, 'desc' => 'Instant soil health and moisture tester.', 'img' => 'https://images.unsplash.com/photo-1580910051074-3eb694886505?q=80&w=800&auto=format&fit=crop'],
        ];

        foreach ($products as $p) {
            Product::create([
                'user_id' => $supplier->id,
                'name' => $p['name'],
                'image_url' => $p['img'],
                'category' => $p['cat'],
                'description' => $p['desc'],
                'price' => $p['price'],
                'stock_quantity' => rand(10, 500),
            ]);
        }
    }
}
