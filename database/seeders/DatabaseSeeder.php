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

        $products = [
            // SEEDS (10)
            ['name' => 'Hybrid Basmati Grains', 'cat' => 'seeds', 'price' => 1250, 'desc' => 'Long-grain high-aroma rice grains for sowing.', 'img' => 'https://images.unsplash.com/photo-1586201375761-83865001e31c?q=80&w=800&auto=format&fit=crop'],
            ['name' => 'Golden Wheat Grains', 'cat' => 'seeds', 'price' => 850, 'desc' => 'Premium hard wheat seeds for high yield.', 'img' => 'https://images.unsplash.com/photo-1574323347407-f5e1ad6d020b?q=80&w=800&auto=format&fit=crop'],
            ['name' => 'Pure Cotton Pod Seeds', 'cat' => 'seeds', 'price' => 1400, 'desc' => 'Verified cotton seeds with high pest resistance.', 'img' => 'https://images.unsplash.com/photo-1593105544230-681940026e6d?q=80&w=800&auto=format&fit=crop'],
            ['name' => 'Yellow Mustard Seeds', 'cat' => 'seeds', 'price' => 450, 'desc' => 'High oil content traditional mustard.', 'img' => 'https://images.unsplash.com/photo-1444858291040-58f756a3bbb6?q=80&w=800&auto=format&fit=crop'],
            ['name' => 'Sweet Corn Kernels', 'cat' => 'seeds', 'price' => 950, 'desc' => 'Fast growing golden maize seeds.', 'img' => 'https://images.unsplash.com/photo-1551754655-cd27e38d2076?q=80&w=800&auto=format&fit=crop'],
            ['name' => 'Hybrid Tomato Seeds', 'cat' => 'seeds', 'price' => 600, 'desc' => 'F1 hybrid seeds for disease-free tomatoes.', 'img' => 'https://images.unsplash.com/photo-1592924357228-91a4daadcfea?q=80&w=800&auto=format&fit=crop'],
            ['name' => 'Teja Chilli Seeds', 'cat' => 'seeds', 'price' => 1100, 'desc' => 'Hot spicy variety for commercial farming.', 'img' => 'https://images.unsplash.com/photo-1583607515847-21017362030a?q=80&w=800&auto=format&fit=crop'],
            ['name' => 'Soybean Seeds', 'cat' => 'seeds', 'price' => 1500, 'desc' => 'Certified high-germination soybean seeds.', 'img' => 'https://images.unsplash.com/photo-1550989460-0adf9ea622e2?q=80&w=800&auto=format&fit=crop'],
            ['name' => 'Red Onion Seeds', 'cat' => 'seeds', 'price' => 800, 'desc' => 'Quality Nasik Red onion seeds.', 'img' => 'https://images.unsplash.com/photo-1508747703725-7197771375a0?q=80&w=800&auto=format&fit=crop'],
            ['name' => 'Sunflower Seeds', 'cat' => 'seeds', 'price' => 1200, 'desc' => 'Premium seeds for oil-rich sunflowers.', 'img' => 'https://images.unsplash.com/photo-1470137430626-983a37b8ea46?q=80&w=800&auto=format&fit=crop'],

            // MANURES (5)
            ['name' => 'Pure Cow Dung Manure', 'cat' => 'manures', 'price' => 350, 'desc' => 'Decomposed organic cow dung for soil richness.', 'img' => 'https://images.unsplash.com/photo-1621460241666-01582236802e?q=80&w=800&auto=format&fit=crop'],
            ['name' => 'Organic Vermicompost', 'cat' => 'manures', 'price' => 480, 'desc' => 'Earthworm processed high-nutrient compost.', 'img' => 'https://images.unsplash.com/photo-1599591037488-3ad5136bb53f?q=80&w=800&auto=format&fit=crop'],
            ['name' => 'Chicken Litter Manure', 'cat' => 'manures', 'price' => 420, 'desc' => 'High nitrogen organic manure for leafy crops.', 'img' => 'https://images.unsplash.com/photo-1548550023-2bdb3c5beed7?q=80&w=800&auto=format&fit=crop'],
            ['name' => 'Green Leaf Manure', 'cat' => 'manures', 'price' => 300, 'desc' => 'Crushed green biomass for natural mulching.', 'img' => 'https://images.unsplash.com/photo-1518531933037-91b2f5f229cc?q=80&w=800&auto=format&fit=crop'],
            ['name' => 'Bio-Slurry Compost', 'cat' => 'manures', 'price' => 550, 'desc' => 'Liquid organic slurry for quick nutrient absorption.', 'img' => 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?q=80&w=800&auto=format&fit=crop'],

            // FERTILIZERS (8)
            ['name' => 'Premium White Urea', 'cat' => 'fertilizers', 'price' => 266, 'desc' => '46% Nitrogen for rapid vegetative growth.', 'img' => 'https://images.unsplash.com/photo-1628352081506-83c43123ed6d?q=80&w=800&auto=format&fit=crop'],
            ['name' => 'DAP (18-46-0)', 'cat' => 'fertilizers', 'price' => 1350, 'desc' => 'Granular fertilizer for strong root establishment.', 'img' => 'https://plus.unsplash.com/premium_photo-1661962386183-500e575824bc?q=80&w=800&auto=format&fit=crop'],
            ['name' => 'NPK 19:19:19', 'cat' => 'fertilizers', 'price' => 1100, 'desc' => '100% water soluble balanced plant food.', 'img' => 'https://images.unsplash.com/photo-1624726128502-18458178cacc?q=80&w=800&auto=format&fit=crop'],
            ['name' => 'Potash (MOP)', 'cat' => 'fertilizers', 'price' => 1700, 'desc' => 'Potassium supplement for grain weight and shine.', 'img' => 'https://images.unsplash.com/photo-1592982537447-6f2a6a0c7c18?q=80&w=800&auto=format&fit=crop'],
            ['name' => 'Zinc Sulphate', 'cat' => 'fertilizers', 'price' => 850, 'desc' => 'Prevents Khaira disease and yellowing.', 'img' => 'https://images.unsplash.com/photo-1584017911766-d451b3d0e843?q=80&w=800&auto=format&fit=crop'],
            ['name' => 'Liquid Zinc Boost', 'cat' => 'fertilizers', 'price' => 600, 'desc' => 'Chelated zinc for foliar spray application.', 'img' => 'https://images.unsplash.com/photo-1586771107445-d3ca888129ff?q=80&w=800&auto=format&fit=crop'],
            ['name' => 'Bio-Potash Liquid', 'cat' => 'fertilizers', 'price' => 500, 'desc' => 'Organic potassium mobilizer for fruits.', 'img' => 'https://images.unsplash.com/photo-1563514227147-6d2ff665a6a0?q=80&w=800&auto=format&fit=crop'],
            ['name' => 'Soil Sulfur Powder', 'cat' => 'fertilizers', 'price' => 750, 'desc' => 'Elemental sulfur for oilseed crop improvement.', 'img' => 'https://images.unsplash.com/photo-1530507629858-e4977d30e9e0?q=80&w=800&auto=format&fit=crop'],

            // TOOLS (7)
            ['name' => 'Hardened Steel Spade', 'cat' => 'tools', 'price' => 450, 'desc' => 'Heavy duty digging tool for Indian soils.', 'img' => 'https://images.unsplash.com/photo-1589923188900-85dae523342b?q=80&w=800&auto=format&fit=crop'],
            ['name' => 'Manual Row Seeder', 'cat' => 'tools', 'price' => 3500, 'desc' => 'Precise manual tool for uniform seed sowing.', 'img' => 'https://images.unsplash.com/photo-1524486361537-8ad15938e1a3?q=80&w=800&auto=format&fit=crop'],
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
