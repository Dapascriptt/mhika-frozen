<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        collect([
            'Sosis',
            'Nugget',
            'Kentang',
            'Ayam Siap Makan',
            'Bakso',
            'Aneka Frozen',
            'Perdagingan',
            'Beef Burger',
            'Sayur dan Buah',
        ])->each(function (string $name) {
            Category::updateOrCreate(
                ['slug' => Str::slug($name)],
                ['name' => $name]
            );
        });
    }
}
