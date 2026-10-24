<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ImageController extends Controller
{
    public function index()
    {
        $files = Storage::disk('public')->files('uploads');

        return view('images.index', compact('files'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $file = $request->file('photo');

        Storage::disk('public')->makeDirectory('uploads');

        $filename = time() . '.' . $file->getClientOriginalExtension();

        // Membuat Image Manager dengan driver GD
        $manager = ImageManager::usingDriver(Driver::class);

        // Membaca gambar yang di-upload
        $image = $manager->decodePath($file->getRealPath());

        // Resize gambar maksimal 300 x 300
        $image->scaleDown(width: 300, height: 300);

        // Menyimpan hasil manipulasi gambar
        $path = Storage::disk('public')->path(
            'uploads/' . $filename
        );

        $image->save($path);

        return redirect()
            ->route('images.index')
            ->with('success', 'Gambar berhasil di-upload dan di-resize!');
    }
}
