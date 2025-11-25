<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class AdminCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }
    
    public function index()
    {
        $categories = Category::withCount('products')->paginate(10);
        
        return view('admin.categories.index', compact('categories'));
    }
    
    public function create()
    {
        return view('admin.categories.create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name'
        ]);
        
        Category::create($request->all());
        
        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil ditambahkan.');
    }
    
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }
    
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id
        ]);
        
        $category->update($request->all());
        
        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil diperbarui.');
    }
    
    public function destroy(Category $category)
    {
        // Cek apakah kategori memiliki produk
        if ($category->products()->count() > 0) {
            return redirect()->route('admin.categories.index')->with('error', 'Kategori tidak dapat dihapus karena masih memiliki produk.');
        }
        
        $category->delete();
        
        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil dihapus.');
    }
}