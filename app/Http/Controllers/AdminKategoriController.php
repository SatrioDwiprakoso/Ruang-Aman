<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class AdminKategoriController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('reports')->orderBy('weight_level', 'desc')->get();
        return view('admin.category.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.category.form', ['category' => null]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_name' => 'required|string|max:150|unique:categories,category_name',
            'weight_level' => 'required|in:Rendah,Sedang,Berat',
        ], [
            'category_name.required' => 'Nama kategori wajib diisi.',
            'category_name.unique' => 'Nama kategori sudah ada.',
            'weight_level.required' => 'Tingkat urgensi wajib dipilih.',
            'weight_level.in' => 'Tingkat urgensi tidak valid.',
        ]);

        Category::create($validated);
        return redirect()->route('admin.kategori')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit(Category $category)
    {
        return view('admin.category.form', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'category_name' => 'required|string|max:150|unique:categories,category_name,' . $category->id_category . ',id_category',
            'weight_level' => 'required|in:Rendah,Sedang,Berat',
        ], [
            'category_name.required' => 'Nama kategori wajib diisi.',
            'category_name.unique' => 'Nama kategori sudah ada.',
            'weight_level.required' => 'Tingkat urgensi wajib dipilih.',
            'weight_level.in' => 'Tingkat urgensi tidak valid.',
        ]);

        $category->update($validated);
        return redirect()->route('admin.kategori')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(Category $category)
    {
        if ($category->reports()->exists()) {
            return back()->withErrors('Kategori tidak bisa dihapus karena masih memiliki pengaduan terkait.');
        }
        $category->delete();
        return back()->with('success', 'Kategori berhasil dihapus.');
    }
}