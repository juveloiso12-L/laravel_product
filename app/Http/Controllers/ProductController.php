<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ProductController extends Controller
{
    // Fungsi untuk menampilkan halaman form
    public function create()
    {
        return view('products.create');
    }

    // Fungsi untuk memproses penyimpanan data dan gambar
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'required|string|max:100|unique:products,sku',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048', // max 2MB
        ]);

        $file = $request->file('image');

        // Jika ada file unggahan, proses gambar
        if ($file) {
            $original = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $ext = strtolower($file->getClientOriginalExtension());
            $filename = time() . '_' . preg_replace('/[^A-Za-z0-9\-_]/', '', $original) . '.' . $ext;
            
            $folder = 'products';
            $path = $folder . '/' . $filename;
            
            $manager = new ImageManager(Driver::class);
            $image = $manager->decodePath($file->getRealPath())->cover(800, 800);
            
            // Encode sesuai ekstensi[cite: 20]
            if ($ext == 'png') {
                $encoded = $image->encodeUsingFileExtension('png', quality: 90);
            } else {
                $encoded = $image->encodeUsingFileExtension('jpg', quality: 85);
            }
            
            // Simpan ke disk public[cite: 20]
            Storage::disk('public')->put($path, $encoded->toString());
            
            // Sertakan path gambar ke data yang akan disimpan ke DB[cite: 20]
            $data['image'] = $path;
        }

        Product::create($data);
        return redirect()->back()->with('success', 'Produk berhasil ditambahkan!'); // Menggunakan format Web
    }
}