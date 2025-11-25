<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $products = Product::query();
        
        // Filter berdasarkan kategori
        if ($request->has('category')) {
            $category = Category::where('name', $request->category)->first();
            if ($category) {
                $products->where('category_id', $category->id);
            }
        }
        
        $products = $products->paginate(12);
        
        return view('products.index', compact('products', 'categories'));
    }
    
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }
}