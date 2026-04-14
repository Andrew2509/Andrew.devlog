<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Template;
use Illuminate\Http\Request;

class TemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $templates = Template::latest()->paginate(10);
        return view('admin.templates.index', compact('templates'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Template::getTypes();
        $contentTypes = Template::getContentTypes();
        return view('admin.templates.create', compact('types', 'contentTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|in:' . implode(',', array_keys(Template::getTypes())),
            'content_type' => 'required|string|in:' . implode(',', array_keys(Template::getContentTypes())),
            'status' => 'boolean',
            'is_new_tab' => 'boolean',
        ]);

        if ($request->content_type === 'link') {
            $request->validate(['content' => 'required|url']);
        } else {
            $request->validate(['content' => 'required|string']);
        }

        $content = $this->transformContent($request->content, $request->content_type);

        Template::create([
            'name' => $request->name,
            'type' => $request->type,
            'content_type' => $request->content_type,
            'content' => $content,
            'status' => $request->has('status'),
            'is_new_tab' => $request->has('is_new_tab'),
        ]);

        return redirect()->route('admin.templates.index')->with('success', 'Template berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Template $template)
    {
        $types = Template::getTypes();
        $contentTypes = Template::getContentTypes();
        return view('admin.templates.edit', compact('template', 'types', 'contentTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Template $template)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|in:' . implode(',', array_keys(Template::getTypes())),
            'content_type' => 'required|string|in:' . implode(',', array_keys(Template::getContentTypes())),
            'status' => 'boolean',
            'is_new_tab' => 'boolean',
        ]);

        if ($request->content_type === 'link') {
            $request->validate(['content' => 'required|url']);
        } else {
            $request->validate(['content' => 'required|string']);
        }

        $content = $this->transformContent($request->content, $request->content_type);

        $template->update([
            'name' => $request->name,
            'type' => $request->type,
            'content_type' => $request->content_type,
            'content' => $content,
            'status' => $request->has('status'),
            'is_new_tab' => $request->has('is_new_tab'),
        ]);

        return redirect()->route('admin.templates.index')->with('success', 'Template berhasil diperbarui.');
    }

    /**
     * Transform link to demo if it matches known patterns
     */
    private function transformContent($content, $contentType)
    {
        if ($contentType !== 'link') {
            return $content;
        }

        // HTML Codex transformation
        // Pattern: https://htmlcodex.com/restoran-website-template/
        // To: https://htmlcodex.com/demo/?template=restoran
        if (preg_match('/htmlcodex\.com\/([^\/]+)-website-template\/?$/i', $content, $matches)) {
            return "https://htmlcodex.com/demo/?template=" . $matches[1];
        }

        return $content;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Template $template)
    {
        $template->delete();
        return redirect()->route('admin.templates.index')->with('success', 'Template berhasil dihapus.');
    }
}
