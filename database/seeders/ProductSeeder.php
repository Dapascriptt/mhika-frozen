<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            ['Sosis Sapi Jumbo', 'Sosis', 45000, 'Sosis sapi ukuran jumbo, praktis untuk bakaran, bekal, dan stok freezer.', 'assets/img/product-1.jpg', true],
            ['Nugget Ayam Crispy', 'Nugget', 38000, 'Nugget ayam renyah dengan rasa gurih yang cocok untuk menu keluarga.', 'assets/img/product-2.jpg', true],
            ['Kentang Shoestring', 'Kentang', 32000, 'Kentang beku potongan tipis, mudah digoreng dan tetap renyah.', 'assets/img/product-3.jpg', true],
            ['Chicken Katsu Frozen', 'Ayam Siap Makan', 52000, 'Katsu ayam berbumbu dengan balutan tepung panir siap goreng.', 'assets/img/product-4.jpg', true],
            ['Bakso Ikan Premium', 'Bakso', 42000, 'Bakso ikan beku dengan tekstur kenyal untuk sup, mi, dan steamboat.', 'assets/img/product-5.jpg', true],
            ['Beef Burger Patty', 'Beef Burger', 58000, 'Patty daging sapi siap panggang untuk burger rumahan.', 'assets/img/product-6.jpg', true],
            ['Mix Vegetable Frozen', 'Sayur dan Buah', 29000, 'Campuran sayuran beku siap masak untuk tumisan, sup, dan side dish.', 'assets/img/product-7.jpg', true],
            ['Ayam Karage', 'Ayam Siap Makan', 49000, 'Ayam karage beku siap goreng untuk lauk praktis.', 'assets/img/product-8.jpg', false],
            ['Daging Slice', 'Perdagingan', 67000, 'Irisan daging beku tipis untuk sukiyaki, grill, dan hotpot.', 'assets/img/product-1.jpg', false],
            ['Aneka Dimsum Frozen', 'Aneka Frozen', 36000, 'Dimsum frozen siap kukus untuk camilan atau menu jualan.', 'assets/img/product-2.jpg', false],
            ['Sosis Ayam Mini', 'Sosis', 31000, 'Sosis ayam mini untuk bekal anak dan campuran nasi goreng.', 'assets/img/product-2.jpg', false],
            ['Nugget Stick Keju', 'Nugget', 41000, 'Nugget stick dengan isian keju ringan untuk camilan cepat.', 'assets/img/product-3.jpg', false],
            ['Bakso Sapi Urat', 'Bakso', 48000, 'Bakso sapi urat beku dengan rasa kuat dan tekstur padat.', 'assets/img/product-4.jpg', false],
        ];

        foreach ($products as [$name, $categoryName, $price, $description, $image, $isFeatured]) {
            $category = Category::where('slug', Str::slug($categoryName))->first();

            Product::updateOrCreate(
                ['slug' => Str::slug($name)],
                [
                    'name' => $name,
                    'description' => $description,
                    'price' => $price,
                    'image' => $image,
                    'category_id' => $category?->id,
                    'is_featured' => $isFeatured,
                    'is_active' => true,
                ]
            );
        }
    }
}
