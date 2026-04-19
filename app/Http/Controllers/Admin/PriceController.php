<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Price;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;

class PriceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $prices = Price::with('category')->orderBy('price')->get();
        return view('admin.pricing.index', compact('prices'));
    }

    public function create()
    {
        $categories = ServiceCategory::orderBy('name')->get();
        return view('admin.pricing.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'service_category_id' => 'required|exists:service_categories,id',
            'service_name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'features' => 'required|string',
            'button_text' => 'required|string|max:255',
            'button_link' => 'required|string|max:255',
        ]);

        $features = array_filter(array_map('trim', explode("\n", $request->features)));
        
        $data = [
            'service_category_id' => $request->service_category_id,
            'service_name' => $request->service_name,
            'price' => $request->price,
            'features' => $features,
            'button_text' => $request->button_text,
            'button_link' => $request->button_link,
            'is_popular' => $request->has('is_popular'),
            'is_visible_home' => $request->has('is_visible_home'),
            'is_visible_pricing' => $request->has('is_visible_pricing'),
        ];

        Price::create($data);

        return redirect()->route('admin.pricing.index')->with('success', 'Paket harga berhasil ditambahkan.');
    }

    public function edit(Price $pricing)
    {
        $categories = ServiceCategory::orderBy('name')->get();
        return view('admin.pricing.edit', compact('pricing', 'categories'));
    }

    public function update(Request $request, Price $pricing)
    {
        $request->validate([
            'service_category_id' => 'required|exists:service_categories,id',
            'service_name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'features' => 'required|string',
            'button_text' => 'required|string|max:255',
            'button_link' => 'required|string|max:255',
        ]);

        $features = array_filter(array_map('trim', explode("\n", $request->features)));

        $data = [
            'service_category_id' => $request->service_category_id,
            'service_name' => $request->service_name,
            'price' => $request->price,
            'features' => $features,
            'button_text' => $request->button_text,
            'button_link' => $request->button_link,
            'is_popular' => $request->has('is_popular'),
            'is_visible_home' => $request->has('is_visible_home'),
            'is_visible_pricing' => $request->has('is_visible_pricing'),
        ];

        $pricing->update($data);

        return redirect()->route('admin.pricing.index')->with('success', 'Paket harga berhasil diperbarui.');
    }

    public function toggleStatus(Price $pricing, $field)
    {
        if (!in_array($field, ['is_visible_home', 'is_visible_pricing', 'is_popular'])) {
            return back()->with('error', 'Field tidak valid.');
        }

        $pricing->update([
            $field => !$pricing->$field
        ]);

        return back()->with('success', 'Status berhasil diperbarui.');
    }

    public function destroy(Price $pricing)
    {
        $pricing->delete();
        return redirect()->route('admin.pricing.index')->with('success', 'Paket harga berhasil dihapus.');
    }
}
