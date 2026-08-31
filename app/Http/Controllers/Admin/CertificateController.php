<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    public function index(Request $request)
    {
        $query = Certificate::query();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $certificates = $query->orderBy('sort_order')->latest()->paginate(10);

        return view('admin.certificates.index', compact('certificates'));
    }

    public function create()
    {
        return view('admin.certificates.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'tagline' => 'nullable|string',
            'file' => 'required|file|mimes:jpg,jpeg,png,pdf|max:10240',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'sort_order' => 'nullable|integer',
        ]);

        $file = $request->file('file');
        $validated['file_path'] = $file->store('certificates', 'public');
        $validated['file_type'] = $file->getClientOriginalExtension();

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail_path'] = $request->file('thumbnail')->store('certificates/thumbnails', 'public');
        }

        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        unset($validated['file'], $validated['thumbnail']);

        Certificate::create($validated);

        return redirect()->route('admin.certificates.index')->with('success', 'Certificate created successfully.');
    }

    public function edit(Certificate $certificate)
    {
        return view('admin.certificates.edit', compact('certificate'));
    }

    public function update(Request $request, Certificate $certificate)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'tagline' => 'nullable|string',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'sort_order' => 'nullable|integer',
            'delete_thumbnail' => 'nullable|boolean',
        ]);

        if ($request->hasFile('file')) {
            \Storage::disk('public')->delete($certificate->file_path);
            $file = $request->file('file');
            $validated['file_path'] = $file->store('certificates', 'public');
            $validated['file_type'] = $file->getClientOriginalExtension();
        }

        if ($request->boolean('delete_thumbnail') && $certificate->thumbnail_path) {
            \Storage::disk('public')->delete($certificate->thumbnail_path);
            $validated['thumbnail_path'] = null;
        }

        if ($request->hasFile('thumbnail')) {
            if ($certificate->thumbnail_path) {
                \Storage::disk('public')->delete($certificate->thumbnail_path);
            }
            $validated['thumbnail_path'] = $request->file('thumbnail')->store('certificates/thumbnails', 'public');
        }

        $validated['sort_order'] = $validated['sort_order'] ?? $certificate->sort_order;
        unset($validated['file'], $validated['thumbnail'], $validated['delete_thumbnail']);

        $certificate->update($validated);

        return redirect()->route('admin.certificates.index')->with('success', 'Certificate updated successfully.');
    }

    public function destroy(Certificate $certificate)
    {
        if ($certificate->file_path) {
            \Storage::disk('public')->delete($certificate->file_path);
        }
        if ($certificate->thumbnail_path) {
            \Storage::disk('public')->delete($certificate->thumbnail_path);
        }

        $certificate->delete();

        return redirect()->route('admin.certificates.index')->with('success', 'Certificate deleted successfully.');
    }
}
