<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $portfolios = Portfolio::latest()->paginate(10);
        return view('admin.portfolio.index', compact('portfolios'));
    }

    public function create()
    {
        return view('admin.portfolio.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'image_type' => 'required|in:file,url',
            'image' => 'required_if:image_type,file|nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
            'image_url' => 'required_if:image_type,url|nullable|url',
            'description' => 'required|string',
            'link' => 'nullable|url',
        ]);

        if ($request->image_type === 'file' && $request->hasFile('image')) {
            $imagePath = $request->file('image')->store('portfolios', 'public');
        } else {
            $imagePath = $request->image_url;
        }

        Portfolio::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'category' => $request->category,
            'image' => $imagePath,
            'description' => $request->description,
            'link' => $request->link,
            'is_featured' => $request->has('is_featured'),
        ]);

        return redirect()->route('admin.portfolio.index')->with('success', 'Project berhasil ditambahkan.');
    }

    public function edit(Portfolio $portfolio)
    {
        return view('admin.portfolio.edit', compact('portfolio'));
    }

    public function update(Request $request, Portfolio $portfolio)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'image_type' => 'required|in:file,url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
            'image_url' => 'required_if:image_type,url|nullable|url',
            'description' => 'required|string',
            'link' => 'nullable|url',
        ]);

        $data = [
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'category' => $request->category,
            'description' => $request->description,
            'link' => $request->link,
            'is_featured' => $request->has('is_featured'),
        ];

        if ($request->image_type === 'file' && $request->hasFile('image')) {
            // Delete old file if exists
            if ($portfolio->image && !str_starts_with($portfolio->image, 'http')) {
                Storage::disk('public')->delete($portfolio->image);
            }
            $data['image'] = $request->file('image')->store('portfolios', 'public');
        } elseif ($request->image_type === 'url' && $request->image_url) {
            // Delete old file if exists
            if ($portfolio->image && !str_starts_with($portfolio->image, 'http')) {
                Storage::disk('public')->delete($portfolio->image);
            }
            $data['image'] = $request->image_url;
        }

        $portfolio->update($data);

        return redirect()->route('admin.portfolio.index')->with('success', 'Project berhasil diperbarui.');
    }

    public function destroy(Portfolio $portfolio)
    {
        Storage::disk('public')->delete($portfolio->image);
        $portfolio->delete();

        return redirect()->route('admin.portfolio.index')->with('success', 'Project berhasil dihapus.');
    }
}
