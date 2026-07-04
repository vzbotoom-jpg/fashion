<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Services\GalleryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GalleryManagementController extends Controller
{
    protected $galleryService;

    public function __construct(GalleryService $galleryService)
    {
        $this->galleryService = $galleryService;
        $this->middleware(['auth', 'role:admin,super_admin']);
    }

    public function index()
    {
        $images = Gallery::orderBy('order')->paginate(20);
        return view('admin.gallery.index', compact('images'));
    }

    public function create()
    {
        return view('admin.gallery.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|max:5120',
            'title' => 'nullable|string|max:200',
            'description' => 'nullable|string',
            'category' => 'nullable|string|max:100',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $this->galleryService->createGalleryImage($request->all());

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Gambar galeri berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $image = Gallery::findOrFail($id);
        return view('admin.gallery.create', compact('image'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'nullable|image|max:5120',
            'title' => 'nullable|string|max:200',
            'description' => 'nullable|string',
            'category' => 'nullable|string|max:100',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $this->galleryService->updateGalleryImage($id, $request->all());

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Gambar galeri berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $this->galleryService->deleteGalleryImage($id);

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Gambar galeri berhasil dihapus!');
    }
}