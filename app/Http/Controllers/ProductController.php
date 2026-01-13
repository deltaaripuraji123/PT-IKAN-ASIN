<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = Category::all();
        $products = Product::query();
        
        // Filter berdasarkan kategori dari parameter URL
        if ($request->has('category')) {
            $category = Category::where('name', $request->category)->first();
            if ($category) {
                $products->where('category_id', $category->id);
            }
        }
        
        // Optimasi: Memuat relasi 'category' sekaligus untuk menghindari N+1 Query problem
        $products = $products->with('category')->paginate(12);
        
        return view('products.index', compact('products', 'categories'));
    }
    
    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        // Optimasi: Memuat relasi 'category' untuk produk utama
        $product->load('category');

        // Logic untuk Mengambil Produk Terkait (Dipindah dari Blade View)
        // Mencari produk lain dalam kategori yang sama, selain produk saat ini
        $relatedProducts = Product::where('category_id', $product->category_id)
                                  ->where('id', '!=', $product->id)
                                  ->inRandomOrder() // Mengacak urutan agar tampilan lebih dinamis
                                  ->take(4)         // Membatasi hanya 4 produk
                                  ->get();
        
        return view('products.show', compact('product', 'relatedProducts'));
    }
}