<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class CollectionManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin,super_admin']);
    }

    public function index()
    {
        $collections = Collection::withCount('products')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.collections.index', compact('collections'));
    }

    public function create()
    {
        return view('admin.collections.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:200|unique:collections',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:5120',
            'is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->all();
        $data['slug'] = Str::slug($request->name);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('collections', 'public');
            $data['image_path'] = $path;
        }

        Collection::create($data);

        return redirect()->route('admin.collections.index')
            ->with('success', 'Koleksi berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $collection = Collection::findOrFail($id);
        return view('admin.collections.edit', compact('collection'));
    }

    public function update(Request $request, $id)
    {
        $collection = Collection::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:200|unique:collections,name,' . $id,
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:5120',
            'is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->all();
        $data['slug'] = Str::slug($request->name);

        if ($request->hasFile('image')) {
            if ($collection->image_path) {
                Storage::delete('public/' . $collection->image_path);
            }
            $path = $request->file('image')->store('collections', 'public');
            $data['image_path'] = $path;
        }

        $collection->update($data);

        return redirect()->route('admin.collections.index')
            ->with('success', 'Koleksi berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $collection = Collection::findOrFail($id);
        
        if ($collection->image_path) {
            Storage::delete('public/' . $collection->image_path);
        }

        $collection->delete();

        return redirect()->route('admin.collections.index')
            ->with('success', 'Koleksi berhasil dihapus!');
    }
}