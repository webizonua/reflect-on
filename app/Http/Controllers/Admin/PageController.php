<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('page/Index', [
            'title' => 'Pages',
            'pages' => Page::orderBy('created_at', 'asc')->paginate(20)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('page/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:pages,slug'],
            'title' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'keywords' => ['nullable', 'string'],
            'content' => ['nullable', 'string'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $data['is_active'] = $request->boolean('is_active');

        Page::create($data);

        return redirect()
            ->route('admin.pages.index')
            ->with('success', 'Page created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Page $page)
    {
        return Inertia::render('page/Edit', [
            'title' => "Edit: {$page->name}",
            'page' => $page,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Page $page)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => "required|string|max:255|unique:pages,slug,{$page->id}",
            'title' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'keywords' => ['nullable', 'string'],
            'content' => ['nullable', 'string'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $data['is_active'] = $request->boolean('is_active');

        $page->update($data);

        return redirect()
            ->route('admin.pages.index')
            ->with('success', 'Page updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Page $page)
    {
        $page->delete();

        return redirect()
            ->route('admin.pages.index')
            ->with('success', 'Page deleted successfully.');
    }
}
