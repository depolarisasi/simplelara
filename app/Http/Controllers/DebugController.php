<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\HandlesImageUploads;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Exception;
use Intervention\Image\Laravel\Facades\Image;

class DebugController extends Controller
{
    use HandlesImageUploads;
    
    // Definisi properti yang diperlukan oleh trait
    protected $imageFieldName = 'debug_image';
    protected $imageDirectory = 'debug_uploads';
    protected $imageWidth = 800; // opsional
    protected $imageHeight = 800; // opsional
    protected $imageQuality = 80; // opsional
    
    /**
     * Tampilkan form untuk upload gambar
     */
    public function index()
    {
        // Get konfigurasi dan status storage untuk debugging
        $storageInfo = [
            'default_disk' => config('filesystems.default'),
            's3_enabled' => !empty(env('AWS_ACCESS_KEY_ID')) && !empty(env('AWS_SECRET_ACCESS_KEY')),
            's3_bucket' => env('AWS_BUCKET'),
            's3_url' => env('AWS_URL'),
            'storage_link_exists' => file_exists(public_path('storage')),
            'public_writeable' => is_writable(storage_path('app/public')),
            'driver_info' => [
                'gd' => extension_loaded('gd') ? 'Installed' : 'Not installed',
                'imagick' => extension_loaded('imagick') ? 'Installed' : 'Not installed',
            ]
        ];
        
        return view('debug.image-upload', ['storage_info' => $storageInfo]);
    }
    
    /**
     * Handle upload gambar dan tampilkan debug info
     */
    public function upload(Request $request)
    {
        // Log semua data request untuk debugging
        Log::info('Debug Image Upload - Request Data', [
            'all' => $request->all(),
            'files' => $request->allFiles(),
            'has_file' => $request->hasFile($this->imageFieldName),
        ]);
        
        // Validasi input
        try {
            $validated = $request->validate(array_merge([
                'notes' => 'nullable|string',
                'storage_type' => 'required|in:s3,local',
            ], $this->imageValidationRules()));
            
            Log::info('Validation passed', $validated);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation failed', [
                'errors' => $e->errors(),
            ]);
            return back()->withErrors($e->errors())->withInput();
        }
        
        // Data debug untuk ditampilkan di view
        $debugData = [
            'request_data' => $request->all(),
            'files_data' => [],
            'process_log' => [],
            'upload_result' => null,
            'storage_type' => $request->storage_type,
            'error' => null
        ];
        
        // Cek apakah ada file
        if ($request->hasFile($this->imageFieldName)) {
            $file = $request->file($this->imageFieldName);
            
            // Kumpulkan info file
            $debugData['files_data'] = [
                'original_name' => $file->getClientOriginalName(),
                'original_extension' => $file->getClientOriginalExtension(),
                'mime_type' => $file->getMimeType(),
                'size' => $file->getSize(),
                'is_valid' => $file->isValid(),
                'error_code' => $file->getError(),
                'temp_path' => $file->getRealPath(),
            ];
            
            try {
                $debugData['process_log'][] = 'Mulai memproses file gambar...';
                
                // Tentukan apakah menggunakan S3 atau storage lokal
                if ($request->storage_type === 's3') {
                    $debugData['process_log'][] = 'Menggunakan Amazon S3 untuk penyimpanan';
                    
                    // Coba upload gambar ke S3 menggunakan trait
                    $imagePath = $this->processAndStoreImage(
                        $file,
                        $this->imageDirectory,
                        'public'
                    );
                    
                    $debugData['process_log'][] = 'Berhasil menyimpan gambar ke S3: ' . $imagePath;
                    $debugData['upload_result'] = [
                        'path' => $imagePath,
                        'url' => Storage::disk('s3')->url($imagePath),
                        'storage' => 's3'
                    ];
                } else {
                    // Gunakan storage lokal sebagai alternatif
                    $debugData['process_log'][] = 'Menggunakan storage lokal (public disk)';
                    $imagePath = $this->processAndStoreLocal($file, $this->imageDirectory);
                    
                    $debugData['process_log'][] = 'Berhasil menyimpan gambar ke local storage: ' . $imagePath;
                    $debugData['upload_result'] = [
                        'path' => $imagePath,
                        'url' => Storage::disk('public')->url($imagePath),
                        'storage' => 'local'
                    ];
                }
                
            } catch (Exception $e) {
                $debugData['process_log'][] = 'Error: ' . $e->getMessage();
                $debugData['error'] = [
                    'message' => $e->getMessage(),
                    'stack_trace' => $e->getTraceAsString()
                ];
                Log::error('Debug Image Upload - Error', [
                    'message' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);
            }
        } else {
            $debugData['process_log'][] = 'Tidak ada file yang diupload';
        }
        
        // Log hasil debug
        Log::info('Debug Image Upload - Complete', ['debug_data' => $debugData]);
        
        // Tampilkan hasil debug
        return view('debug.image-result', ['debug' => $debugData]);
    }
    
    /**
     * Memproses dan menyimpan gambar ke storage lokal sebagai alternatif S3
     * Function ini berguna untuk debugging
     */
    private function processAndStoreLocal($image, $directory = 'debug_uploads')
    {
        try {
            // Generate nama file yang aman
            $originalExtension = strtolower($image->getClientOriginalExtension());
            $filename = Str::slug(pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME))
                      . '_' . uniqid()
                      . '.' . $originalExtension;
                      
            $path = "{$directory}/{$filename}";
            
            // Baca dan proses gambar menggunakan Intervention Image
            $img = Image::read($image);
            
            // Encode ke format yang sesuai
            $encodedImage = match ($originalExtension) {
                'jpeg', 'jpg' => $img->toJpeg($this->imageQuality),
                'png' => $img->toPng(),
                'gif' => $img->toGif(),
                'webp' => $img->toWebp($this->imageQuality),
                default => $img->toJpeg($this->imageQuality),
            };
            
            // Simpan ke disk public
            Storage::disk('public')->put($path, (string) $encodedImage);
            
            // Verifikasi file telah disimpan
            if (!Storage::disk('public')->exists($path)) {
                throw new Exception('File berhasil diproses tetapi tidak ditemukan di storage');
            }
            
            return $path;
            
        } catch (Exception $e) {
            Log::error("Local image processing/upload failed: " . $e->getMessage());
            throw new Exception("Gagal memproses atau menyimpan gambar ke local storage: " . $e->getMessage());
        }
    }
} 