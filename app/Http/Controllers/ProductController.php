<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\JpegEncoder;

class ProductController extends Controller
{
    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'gambar' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Mengambil file gambar
        $gambar = $request->file('gambar');

        // Membuat Image Manager menggunakan driver GD
        $manager = new ImageManager(new Driver());

        // Membaca gambar yang diunggah
        $image = $manager->decodePath($gambar->getRealPath());

        // Resize maksimal 800 x 800 tanpa mengubah proporsi
        $image->scaleDown(width: 800, height: 800);

        // Mengubah gambar menjadi format JPEG
        $encoded = $image->encode(new JpegEncoder(quality: 80));

        // Membuat nama file unik
        $namaFile = uniqid('produk_') . '.jpg';

        // Menyimpan gambar ke storage/app/public/products
        Storage::disk('public')->put(
            'products/' . $namaFile,
            (string) $encoded
        );

        // Kembali ke halaman form dengan pesan berhasil
        return back()->with([
            'success' => 'Gambar produk berhasil diunggah dan diproses!',
            'nama_produk' => $request->nama_produk,
            'gambar' => $namaFile,
        ]);
    }
}
