<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;

class ServiceCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = ServiceCategory::with('parent', 'children')
            ->orderBy('order')
            ->orderBy('name')
            ->get();
        return view('admin.service-categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parentCategories = ServiceCategory::whereNull('parent_id')->orderBy('name')->get();
        return view('admin.service-categories.create', compact('parentCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:service_categories,id',
            'icon' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|string|max:1000',
            'order' => 'nullable|integer|min:0',
        ]);

        $validated['slug'] = \Illuminate\Support\Str::slug($request->name);

        ServiceCategory::create($validated);

        return redirect()->route('admin.service_categories.index')
            ->with('success', 'Kategori Berhasil Ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ServiceCategory $serviceCategory)
    {
        $parentCategories = ServiceCategory::whereNull('parent_id')
            ->where('id', '!=', $serviceCategory->id)
            ->orderBy('name')
            ->get();
        return view('admin.service-categories.edit', compact('serviceCategory', 'parentCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ServiceCategory $serviceCategory)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:service_categories,id',
            'icon' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|string|max:1000',
            'order' => 'nullable|integer|min:0',
        ]);

        $validated['slug'] = \Illuminate\Support\Str::slug($request->name);

        $serviceCategory->update($validated);

        return redirect()->route('admin.service_categories.index')
            ->with('success', 'Kategori Berhasil Diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ServiceCategory $serviceCategory)
    {
        $serviceCategory->delete();
        return redirect()->route('admin.service_categories.index')
            ->with('success', 'Kategori Berhasil Dihapus!');
    }
}
