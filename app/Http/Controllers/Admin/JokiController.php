<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JokiService;
use App\Models\JokiPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class JokiController extends Controller
{
    public function index()
    {
        $services = JokiService::withCount('packages')->orderBy('order')->get();
        return view('admin.joki.index', compact('services'));
    }

    public function createService()
    {
        return view('admin.joki.create_service');
    }

    public function storeService(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'desc' => 'required|string',
            'icon' => 'required|string|max:255',
            'price' => 'nullable|string|max:255',
            'order' => 'required|integer',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title);

        JokiService::create($data);

        return redirect()->route('admin.joki.index')->with('success', 'Layanan Joki berhasil ditambahkan.');
    }

    public function editService(JokiService $service)
    {
        return view('admin.joki.edit_service', compact('service'));
    }

    public function updateService(Request $request, JokiService $service)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'desc' => 'required|string',
            'icon' => 'required|string|max:255',
            'price' => 'nullable|string|max:255',
            'order' => 'required|integer',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title);

        $service->update($data);

        return redirect()->route('admin.joki.index')->with('success', 'Layanan Joki berhasil diperbarui.');
    }

    public function destroyService(JokiService $service)
    {
        $service->delete();
        return redirect()->route('admin.joki.index')->with('success', 'Layanan Joki berhasil dihapus.');
    }

    // Package Methods
    public function indexPackages(JokiService $service)
    {
        $packages = $service->packages;
        return view('admin.joki.packages.index', compact('service', 'packages'));
    }

    public function createPackage(JokiService $service)
    {
        return view('admin.joki.packages.create', compact('service'));
    }

    public function storePackage(Request $request, JokiService $service)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|string|max:255',
            'features' => 'required|string',
            'order' => 'required|integer',
        ]);

        $features = array_filter(array_map('trim', explode("\n", $request->features)));

        $service->packages()->create([
            'title' => $request->title,
            'desc' => $request->desc,
            'price' => $request->price,
            'features' => $features,
            'order' => $request->order,
        ]);

        return redirect()->route('admin.joki.packages.index', $service)->with('success', 'Paket Joki berhasil ditambahkan.');
    }

    public function editPackage(JokiService $service, JokiPackage $package)
    {
        return view('admin.joki.packages.edit', compact('service', 'package'));
    }

    public function updatePackage(Request $request, JokiService $service, JokiPackage $package)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|string|max:255',
            'features' => 'required|string',
            'order' => 'required|integer',
        ]);

        $features = array_filter(array_map('trim', explode("\n", $request->features)));

        $package->update([
            'title' => $request->title,
            'desc' => $request->desc,
            'price' => $request->price,
            'features' => $features,
            'order' => $request->order,
        ]);

        return redirect()->route('admin.joki.packages.index', $service)->with('success', 'Paket Joki berhasil diperbarui.');
    }

    public function destroyPackage(JokiService $service, JokiPackage $package)
    {
        $package->delete();
        return redirect()->route('admin.joki.packages.index', $service)->with('success', 'Paket Joki berhasil dihapus.');
    }
}
