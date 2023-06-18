<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\Item;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['provider' => 'Telkomsel', 'option' => 'Simpati 5k', 'price' => 6000],
            ['provider' => 'Telkomsel', 'option' => 'Simpati 10k', 'price' => 11000],
            ['provider' => 'Telkomsel', 'option' => 'Simpati 15k', 'price' => 16000],
            ['provider' => 'Telkomsel', 'option' => 'Simpati 20k', 'price' => 22000],
            ['provider' => 'Telkomsel', 'option' => 'Simpati 25k', 'price' => 27000],
            ['provider' => 'Telkomsel', 'option' => 'Simpati 30k', 'price' => 32000],
            ['provider' => 'Telkomsel', 'option' => 'Simpati 40k', 'price' => 42000],
            ['provider' => 'Telkomsel', 'option' => 'Simpati 45k', 'price' => 47000],
            ['provider' => 'Telkomsel', 'option' => 'Simpati 50k', 'price' => 52000],
            ['provider' => 'Telkomsel', 'option' => 'Simpati 60k', 'price' => 62000],
            ['provider' => 'Telkomsel', 'option' => 'Simpati 70k', 'price' => 72000],
            ['provider' => 'Telkomsel', 'option' => 'Simpati 75k', 'price' => 78000],
            ['provider' => 'Telkomsel', 'option' => 'Simpati 80k', 'price' => 83000],
            ['provider' => 'Telkomsel', 'option' => 'Simpati 90k', 'price' => 93000],
            ['provider' => 'Telkomsel', 'option' => 'Simpati 100k', 'price' => 102500],
            ['provider' => 'Telkomsel', 'option' => 'Simpati 150k', 'price' => 153000],
            ['provider' => 'XL', 'option' => 'XL 5k', 'price' => 7000],
            ['provider' => 'XL', 'option' => 'XL 10k', 'price' => 12000],
            ['provider' => 'XL', 'option' => 'XL 15k', 'price' => 16000],
            ['provider' => 'XL', 'option' => 'XL 25k', 'price' => 26000],
            ['provider' => 'XL', 'option' => 'XL 30k', 'price' => 31000],
            ['provider' => 'XL', 'option' => 'XL 50k', 'price' => 52000],
            ['provider' => 'XL', 'option' => 'XL 100k', 'price' => 102000],
            ['provider' => 'XL', 'option' => 'XL 150k', 'price' => 151000],
        ];

        foreach ($data as $itemData) {
            Item::create($itemData);
        }
    }
}
