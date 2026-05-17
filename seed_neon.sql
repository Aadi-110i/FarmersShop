-- SEED DATA FOR FARMERSSHOP
-- Run this in Neon SQL Editor (console.neon.tech)

-- 1. Create supplier user
INSERT INTO users (name, email, password, role, remember_token, created_at, updated_at)
VALUES (
    'Bharat Agri Supplies',
    'supplier@example.com',
    '$2y$12$ohqaFcmY.4uDA9ZTeL3E3.4ssGoi0LCni5Y55ZUuxmXquleYFugfe',
    'supplier',
    NULL,
    NOW(),
    NOW()
) ON CONFLICT (email) DO NOTHING;

-- 2. Create farmer user
INSERT INTO users (name, email, password, role, remember_token, created_at, updated_at)
VALUES (
    'Kisan Kumar',
    'farmer@example.com',
    '$2y$12$ohqaFcmY.4uDA9ZTeL3E3.4ssGoi0LCni5Y55ZUuxmXquleYFugfe',
    'farmer',
    NULL,
    NOW(),
    NOW()
) ON CONFLICT (email) DO NOTHING;

-- 3. Get supplier ID for products
-- Products reference user_id=1 (the supplier)

-- 4. Insert all 30 products
INSERT INTO products (user_id, name, image_url, category, description, price, stock_quantity, created_at, updated_at) VALUES
-- SEEDS (10)
(1, 'Hybrid Basmati Grains', '/images/products/seed_basmati.png', 'seeds', 'Long-grain high-aroma rice grains for sowing.', 1250.00, 150, NOW(), NOW()),
(1, 'Golden Wheat Grains', '/images/products/seed_wheat.png', 'seeds', 'Premium hard wheat seeds for high yield.', 850.00, 200, NOW(), NOW()),
(1, 'Pure Cotton Pod Seeds', '/images/products/seed_cotton.png', 'seeds', 'Verified cotton seeds with high pest resistance.', 1400.00, 100, NOW(), NOW()),
(1, 'Yellow Mustard Seeds', '/images/products/seed_mustard.png', 'seeds', 'High oil content traditional mustard.', 450.00, 300, NOW(), NOW()),
(1, 'Sweet Corn Kernels', '/images/products/seed_corn.png', 'seeds', 'Fast growing golden maize seeds.', 950.00, 250, NOW(), NOW()),
(1, 'Hybrid Tomato Seeds', '/images/products/seed_tomato.png', 'seeds', 'F1 hybrid seeds for disease-free tomatoes.', 600.00, 180, NOW(), NOW()),
(1, 'Teja Chilli Seeds', 'https://images.unsplash.com/photo-1583607515847-21017362030a?q=80&w=800&auto=format&fit=crop', 'seeds', 'Hot spicy variety for commercial farming.', 1100.00, 120, NOW(), NOW()),
(1, 'Soybean Seeds', 'https://images.unsplash.com/photo-1550989460-0adf9ea622e2?q=80&w=800&auto=format&fit=crop', 'seeds', 'Certified high-germination soybean seeds.', 1500.00, 90, NOW(), NOW()),
(1, 'Red Onion Seeds', 'https://images.unsplash.com/photo-1508747703725-7197771375a0?q=80&w=800&auto=format&fit=crop', 'seeds', 'Quality Nasik Red onion seeds.', 800.00, 220, NOW(), NOW()),
(1, 'Sunflower Seeds', 'https://images.unsplash.com/photo-1470137430626-983a37b8ea46?q=80&w=800&auto=format&fit=crop', 'seeds', 'Premium seeds for oil-rich sunflowers.', 1200.00, 170, NOW(), NOW()),
-- MANURES (5)
(1, 'Pure Cow Dung Manure', 'https://images.unsplash.com/photo-1416879595882-3373a0480b5b?q=80&w=800&auto=format&fit=crop', 'manures', 'Decomposed organic cow dung for soil richness.', 350.00, 400, NOW(), NOW()),
(1, 'Organic Vermicompost', 'https://images.unsplash.com/photo-1464226184884-fa280b87c399?q=80&w=800&auto=format&fit=crop', 'manures', 'Earthworm processed high-nutrient compost.', 480.00, 350, NOW(), NOW()),
(1, 'Chicken Litter Manure', 'https://images.unsplash.com/photo-1500382017468-9049fed747ef?q=80&w=800&auto=format&fit=crop', 'manures', 'High nitrogen organic manure for leafy crops.', 420.00, 280, NOW(), NOW()),
(1, 'Green Leaf Manure', 'https://images.unsplash.com/photo-1518531933037-91b2f5f229cc?q=80&w=800&auto=format&fit=crop', 'manures', 'Crushed green biomass for natural mulching.', 300.00, 500, NOW(), NOW()),
(1, 'Bio-Slurry Compost', 'https://images.unsplash.com/photo-1530836369250-ef72a3f5cda8?q=80&w=800&auto=format&fit=crop', 'manures', 'Liquid organic slurry for quick nutrient absorption.', 550.00, 190, NOW(), NOW()),
-- FERTILIZERS (8)
(1, 'Premium White Urea', 'https://images.unsplash.com/photo-1628352081506-83c43123ed6d?q=80&w=800&auto=format&fit=crop', 'fertilizers', '46% Nitrogen for rapid vegetative growth.', 266.00, 450, NOW(), NOW()),
(1, 'DAP (18-46-0)', 'https://images.unsplash.com/photo-1625246333195-78d9c38ad449?q=80&w=800&auto=format&fit=crop', 'fertilizers', 'Granular fertilizer for strong root establishment.', 1350.00, 130, NOW(), NOW()),
(1, 'NPK 19:19:19', 'https://images.unsplash.com/photo-1592982537447-6f2a6a0c7c18?q=80&w=800&auto=format&fit=crop', 'fertilizers', '100% water soluble balanced plant food.', 1100.00, 200, NOW(), NOW()),
(1, 'Potash (MOP)', 'https://images.unsplash.com/photo-1622383563227-04401ab4e5ea?q=80&w=800&auto=format&fit=crop', 'fertilizers', 'Potassium supplement for grain weight and shine.', 1700.00, 80, NOW(), NOW()),
(1, 'Zinc Sulphate', 'https://images.unsplash.com/photo-1584017911766-d451b3d0e843?q=80&w=800&auto=format&fit=crop', 'fertilizers', 'Prevents Khaira disease and yellowing.', 850.00, 300, NOW(), NOW()),
(1, 'Liquid Zinc Boost', 'https://images.unsplash.com/photo-1586771107445-d3ca888129ff?q=80&w=800&auto=format&fit=crop', 'fertilizers', 'Chelated zinc for foliar spray application.', 600.00, 250, NOW(), NOW()),
(1, 'Bio-Potash Liquid', 'https://images.unsplash.com/photo-1563514227147-6d2ff665a6a0?q=80&w=800&auto=format&fit=crop', 'fertilizers', 'Organic potassium mobilizer for fruits.', 500.00, 320, NOW(), NOW()),
(1, 'Soil Sulfur Powder', 'https://images.unsplash.com/photo-1530507629858-e4977d30e9e0?q=80&w=800&auto=format&fit=crop', 'fertilizers', 'Elemental sulfur for oilseed crop improvement.', 750.00, 180, NOW(), NOW()),
-- TOOLS (7)
(1, 'Hardened Steel Spade', 'https://images.unsplash.com/photo-1589923188900-85dae523342b?q=80&w=800&auto=format&fit=crop', 'tools', 'Heavy duty digging tool for Indian soils.', 450.00, 150, NOW(), NOW()),
(1, 'Manual Row Seeder', 'https://images.unsplash.com/photo-1523348837708-15d4a09cfac2?q=80&w=800&auto=format&fit=crop', 'tools', 'Precise manual tool for uniform seed sowing.', 3500.00, 40, NOW(), NOW()),
(1, '16L Knapsack Sprayer', 'https://images.unsplash.com/photo-1590682680695-43b964a3ae17?q=80&w=800&auto=format&fit=crop', 'tools', 'Durable backpack sprayer for crop protection.', 2200.00, 60, NOW(), NOW()),
(1, 'Iron Garden Rake', 'https://images.unsplash.com/photo-1592419044706-39796d40f98c?q=80&w=800&auto=format&fit=crop', 'tools', 'Iron 12-tooth strong rake for field leveling.', 350.00, 200, NOW(), NOW()),
(1, 'Heavy Ground Pickaxe', 'https://images.unsplash.com/photo-1558905619-17254261be64?q=80&w=800&auto=format&fit=crop', 'tools', 'Double-headed pickaxe for hard rocky soil.', 750.00, 100, NOW(), NOW()),
(1, 'Harvesting Sickle', 'https://images.unsplash.com/photo-1589923188651-268a9765e432?q=80&w=800&auto=format&fit=crop', 'tools', 'Sharp high-carbon steel harvesting blade.', 180.00, 350, NOW(), NOW()),
(1, 'Digital PH Monitor', 'https://images.unsplash.com/photo-1580910051074-3eb694886505?q=80&w=800&auto=format&fit=crop', 'tools', 'Instant soil health and moisture tester.', 1200.00, 90, NOW(), NOW());
