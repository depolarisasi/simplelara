<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AppSlider;
use App\Traits\HandlesImageUploads;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AppSliderController extends Controller
{
    use HandlesImageUploads;

    /**
     * Nama field input untuk gambar di form
     * 
     * @var string
     */
    protected $imageFieldName = 'slider_url';

    /**
     * Direktori tujuan di dalam storage
     * 
     * @var string
     */
    protected $imageDirectory = 'sliders';
 

    /**
     * Menampilkan daftar slider
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = AppSlider::all();
        return view('admin.sliders.index', compact('sliders'));
    }

    /**
     * Menyimpan slider baru
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'slider_title' => 'required|string|max:255',
            'slider_caption' => 'required|string',
            'slider_type' => 'required|in:Big,Small',
            'slider_url' => 'required|image|mimes:jpeg,png,jpg,gif|max:10000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Upload gambar
            $imagePath = null;
            if ($request->hasFile('slider_url')) {
                $imagePath = $this->processAndStoreImage($request->file('slider_url'));
            }

            AppSlider::create([
                'slider_title' => $request->slider_title,
                'slider_caption' => $request->slider_caption,
                'slider_type' => $request->slider_type,
                'slider_url' => $imagePath,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Slider berhasil ditambahkan'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Mendapatkan data slider untuk diedit
     * 
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($id)
    {
        $slider = AppSlider::findOrFail($id);
        
        return response()->json([
            'success' => true,
            'data' => $slider,
            'image_url' => $this->getTemporaryUrl($slider->slider_url)
        ]);
    }

    /**
     * Mendapatkan URL sementara untuk gambar dari S3
     * 
     * @param string $path
     * @return string
     */
    private function getTemporaryUrl($path)
    {
        if (!$path) {
            return null;
        }
        
        try {
            // Membuat URL sementara yang berlaku 30 menit dan sudah ditandatangani
            return Storage::disk('s3')->temporaryUrl($path, now()->addMinutes(30));
        } catch (\Exception $e) {
            // Jika gagal, kembalikan URL biasa dan log error
            \Log::error('Gagal membuat temporary URL: ' . $e->getMessage());
            return Storage::disk('s3')->url($path);
        }
    }

    /**
     * Memperbarui slider
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $slider = AppSlider::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'slider_title' => 'required|string|max:255',
            'slider_caption' => 'required|string',
            'slider_type' => 'required|in:Big,Small',
            'slider_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Upload gambar jika ada
            $imagePath = $slider->slider_url;
            if ($request->hasFile('slider_url')) {
                // Hapus gambar lama jika ada
                if ($slider->slider_url) {
                    $this->deleteOldImage($slider->slider_url);
                }
                $imagePath = $this->processAndStoreImage($request->file('slider_url'));
            }

            $slider->update([
                'slider_title' => $request->slider_title,
                'slider_caption' => $request->slider_caption,
                'slider_type' => $request->slider_type,
                'slider_url' => $imagePath,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Slider berhasil diperbarui'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Menghapus slider
     * 
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            $slider = AppSlider::findOrFail($id);
            
            // Hapus file gambar jika ada
            if ($slider->slider_url) {
                $this->deleteOldImage($slider->slider_url);
            }
            
            $slider->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Slider berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
} 