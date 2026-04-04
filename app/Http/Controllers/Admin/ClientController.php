<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::orderBy('order')->get();
        return view('admin.clients.index', compact('clients'));
    }

    public function create()
    {
        return view('admin.clients.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'logo_type' => 'required|in:file,url',
            'logo' => 'required_if:logo_type,file|nullable|image|mimes:jpeg,png,jpg,svg,webp|max:2048',
            'logo_url' => 'required_if:logo_type,url|nullable|url',
            'url' => 'nullable|url',
            'is_active' => 'boolean',
            'order' => 'integer'
        ]);

        $data = $request->except(['logo', 'logo_url', 'logo_type']);
        
        if ($request->logo_type === 'file' && $request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('clients', 'public');
        } else {
            $data['logo'] = $request->logo_url;
        }

        Client::create($data);

        return redirect()->route('admin.clients.index')->with('success', 'Client berhasil ditambahkan.');
    }

    public function edit(Client $client)
    {
        return view('admin.clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'logo_type' => 'required|in:file,url',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,svg,webp|max:2048',
            'logo_url' => 'required_if:logo_type,url|nullable|url',
            'url' => 'nullable|url',
            'is_active' => 'boolean',
            'order' => 'integer'
        ]);

        $data = $request->except(['logo', 'logo_url', 'logo_type']);

        if ($request->logo_type === 'file' && $request->hasFile('logo')) {
            // Delete old logo if it was a file
            if ($client->logo && !str_starts_with($client->logo, 'http')) {
                Storage::disk('public')->delete($client->logo);
            }
            $data['logo'] = $request->file('logo')->store('clients', 'public');
        } elseif ($request->logo_type === 'url' && $request->logo_url) {
            // Delete old logo if it was a file
            if ($client->logo && !str_starts_with($client->logo, 'http')) {
                Storage::disk('public')->delete($client->logo);
            }
            $data['logo'] = $request->logo_url;
        }

        $client->update($data);

        return redirect()->route('admin.clients.index')->with('success', 'Client berhasil diperbarui.');
    }

    public function destroy(Client $client)
    {
        if ($client->logo) {
            Storage::disk('public')->delete($client->logo);
        }
        $client->delete();

        return redirect()->route('admin.clients.index')->with('success', 'Client berhasil dihapus.');
    }

    public function toggle(Client $client, $field)
    {
        if ($field === 'is_active') {
            $client->update(['is_active' => !$client->is_active]);
        }
        
        return response()->json(['success' => true]);
    }
}
