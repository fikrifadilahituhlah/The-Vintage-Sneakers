<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    private array $prices = [
        'Hi-Court Canvas' => 1850000,
        'Court Racer Leather' => 1650000,
        'Atelier Leather High' => 2400000,
        'Trail Suede Runner' => 1450000,
        'Foundry Canvas High' => 1250000,
        'Atelier Leather Low' => 2100000,
        'Varsity Canvas High' => 1950000,
        'Court Racer Classic' => 1350000,
        'Atelier Leather Navy' => 2250000,
    ];

    public function up(): void
    {
        foreach ($this->prices as $name => $price) {
            DB::table('products')->where('name', $name)->update(['price' => $price]);
        }
    }

    public function down(): void
    {
        $previousPrices = [
            'Hi-Court Canvas' => 9150000,
            'Court Racer Leather' => 7800000,
            'Atelier Leather High' => 12600000,
            'Trail Suede Runner' => 7050000,
            'Foundry Canvas High' => 5700000,
            'Atelier Leather Low' => 10350000,
            'Varsity Canvas High' => 9750000,
            'Court Racer Classic' => 6150000,
            'Atelier Leather Navy' => 11850000,
        ];

        foreach ($previousPrices as $name => $price) {
            DB::table('products')->where('name', $name)->update(['price' => $price]);
        }
    }
};
