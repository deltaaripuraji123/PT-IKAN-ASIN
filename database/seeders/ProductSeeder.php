<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Ikan Teri Asin Premium',
                'description' => 'Ikan teri asin berkualitas tinggi, gurih dan renyah',
                'price' => 45000,
                'stock' => 100,
                'category_name' => 'Ikan Asin Premium',
                'image' => 'teri_premium.jpg'
            ],
            [
                'name' => 'Ikan Layang Asin Kering',
                'description' => 'Ikan layang asin kering dengan kualitas terbaik',
                'price' => 35000,
                'stock' => 75,
                'category_name' => 'Ikan Asin Kering',
                'image' => 'layang_kering.jpg'
            ],
            [
                'name' => 'Ikan Tongkol Asin Basah',
                'description' => 'Ikan tongkol asin basah segar langsung dari nelayan',
                'price' => 55000,
                'stock' => 50,
                'category_name' => 'Ikan Asin Basah',
                'image' => 'tongkol_basah.jpg'
            ],
            [
                'name' => 'Ikan Cue Asin Premium',
                'description' => 'Ikan cue asin premium dengan daging tebal dan gurih',
                'price' => 60000,
                'stock' => 40,
                'category_name' => 'Ikan Asin Premium',
                'image' => 'cue_premium.jpg'
            ],
            [
                'name' => 'Ikan Peda Kering',
                'description' => 'Ikan peda kering dengan rasa asin yang pas',
                'price' => 40000,
                'stock' => 60,
                'category_name' => 'Ikan Asin Kering',
                'image' => 'peda_kering.jpg'
            ],
            [
                'name' => 'Ikan Jambal Roti Asin Basah',
                'description' => 'Ikan jambal roti asin basah berkualitas tinggi',
                'price' => 70000,
                'stock' => 30,
                'category_name' => 'Ikan Asin Basah',
                'image' => 'jambal_roti.jpg'
            ],
            [
                'name' => 'Ikan Salem Asin Premium',
                'description' => 'Ikan salem asin premium dengan daging lembut',
                'price' => 65000,
                'stock' => 45,
                'category_name' => 'Ikan Asin Premium',
                'image' => 'salem_premium.jpg'
            ],
            [
                'name' => 'Ikan Bawal Asin Kering',
                'description' => 'Ikan bawal asin kering dengan kualitas terbaik',
                'price' => 50000,
                'stock' => 55,
                'category_name' => 'Ikan Asin Kering',
                'image' => 'bawal_kering.jpg'
            ],
            [
                'name' => 'Ikan Kakap Asin Basah',
                'description' => 'Ikan kakap asin basah segar dan berkualitas',
                'price' => 80000,
                'stock' => 25,
                'category_name' => 'Ikan Asin Basah',
                'image' => 'kakap_basah.jpg'
            ],
            [
                'name' => 'Ikan Bandeng Asin Premium',
                'description' => 'Ikan bandeng asin premium tanpa duri',
                'price' => 75000,
                'stock' => 35,
                'category_name' => 'Ikan Asin Premium',
                'image' => 'bandeng_premium.jpg'
            ],
        ];
        
        foreach ($products as $product) {
            $category = Category::where('name', $product['category_name'])->first();
            
            Product::create([
                'name' => $product['name'],
                'description' => $product['description'],
                'price' => $product['price'],
                'stock' => $product['stock'],
                'image' => $product['image'],
                'category_id' => $category->id,
            ]);
        }
    }
}