<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (DB::table('products')->exists()) {
            return;
        }

        DB::table('products')->insert([
            [
                'name' => 'Hi-Court Canvas',
                'type' => 'high-top',
                'type_label' => 'High-Top',
                'description' => 'Cream canvas high-top with navy leather trim and brass eyelets. Original box and hang tag included.',
                'price' => 1850000,
                'image' => 'items-Hi Court Canvas.png',
                'grade' => 'ds',
                'grade_label' => 'DS 10/10',
                'rating' => 4,
                'stock' => 2,
                'sizes' => json_encode(['39', '40', '41', '42', '43']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Court Racer Leather',
                'type' => 'low-top',
                'type_label' => 'Low-Top',
                'description' => 'White and pine-green leather low-top with gold branding. Worn twice by the original owner.',
                'price' => 1650000,
                'image' => 'items-Court Racer Leather.png',
                'grade' => 'vnds',
                'grade_label' => 'VNDS 9/10',
                'rating' => 5,
                'stock' => 1,
                'sizes' => json_encode(['39', '40', '41', '42', '43']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Atelier Leather High',
                'type' => 'premium',
                'type_label' => 'Premium',
                'description' => 'Full-grain cream leather high-top with burgundy heel tab. Deadstock, hand-conditioned on arrival.',
                'price' => 2400000,
                'image' => 'items-Atelier Leather High.png',
                'grade' => 'ds',
                'grade_label' => 'DS 10/10',
                'rating' => 5,
                'stock' => 1,
                'sizes' => json_encode(['40', '41', '42', '43']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Trail Suede Runner',
                'type' => 'low-top',
                'type_label' => 'Low-Top',
                'description' => 'Tan suede low-top with rust-orange midsole. Never worn, original lacing still factory-tied.',
                'price' => 1450000,
                'image' => 'items-Trail Suede Runner.png',
                'grade' => 'ds',
                'grade_label' => 'DS 10/10',
                'rating' => 4,
                'stock' => 3,
                'sizes' => json_encode(['39', '40', '41', '42', '43', '44']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Foundry Canvas High',
                'type' => 'high-top',
                'type_label' => 'High-Top',
                'description' => 'Charcoal canvas high-top with reinforced toe cap. Light creasing consistent with careful wear.',
                'price' => 1250000,
                'image' => 'items-Foundry Canvas High.png',
                'grade' => 'vnds',
                'grade_label' => 'VNDS 8/10',
                'rating' => 3,
                'stock' => 2,
                'sizes' => json_encode(['40', '41', '42', '43']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Atelier Leather Low',
                'type' => 'premium',
                'type_label' => 'Premium',
                'description' => 'Burgundy full-grain leather low-top with contrast stitching. Worn once, includes dust bag.',
                'price' => 2100000,
                'image' => 'items-Atelier Leather Low.png',
                'grade' => 'vnds',
                'grade_label' => 'VNDS 9/10',
                'rating' => 4,
                'stock' => 1,
                'sizes' => json_encode(['40', '41', '42', '43']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Varsity Canvas High',
                'type' => 'high-top',
                'type_label' => 'High-Top',
                'description' => 'Cream canvas with burgundy stripe detailing. Deadstock with original retail sticker intact.',
                'price' => 1950000,
                'image' => 'items-Varsity Canvas High.png',
                'grade' => 'ds',
                'grade_label' => 'DS 10/10',
                'rating' => 5,
                'stock' => 2,
                'sizes' => json_encode(['39', '40', '41', '42', '43']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Court Racer Classic',
                'type' => 'low-top',
                'type_label' => 'Low-Top',
                'description' => 'White leather low-top with black accents. Honest wear on the outsole, upper still crisp.',
                'price' => 1350000,
                'image' => 'items-Court Racer Classic.png',
                'grade' => 'vnds',
                'grade_label' => 'VNDS 8/10',
                'rating' => 3,
                'stock' => 2,
                'sizes' => json_encode(['39', '40', '41', '42', '43']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Atelier Leather Navy',
                'type' => 'premium',
                'type_label' => 'Premium',
                'description' => 'Navy full-grain leather high-top with brass hardware. Deadstock, still in factory tissue.',
                'price' => 2250000,
                'image' => 'items-Atelier Leather Navy.png',
                'grade' => 'ds',
                'grade_label' => 'DS 10/10',
                'rating' => 4,
                'stock' => 1,
                'sizes' => json_encode(['40', '41', '42', '43']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}


