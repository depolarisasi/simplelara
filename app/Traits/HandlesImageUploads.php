<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile; // Lebih spesifik dari Request
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
// Gunakan Facade v3
use Intervention\Image\Laravel\Facades\Image; 
use Exception;
use Illuminate\Support\Facades\Log;

trait HandlesImageUploads
{
    /**
     * Nama field input untuk gambar di form.
     * Definisikan ini di Controller yang menggunakan trait.
     * @var string
     */
    // protected $imageFieldName = 'image';

    /**
     * Direktori tujuan di dalam bucket S3.
     * Definisikan ini di Controller yang menggunakan trait.
     * @var string
     */
    // protected $imageDirectory = 'uploads';

    /**
     * Lebar gambar maksimum setelah resize.
     * Definisikan ini di Controller (opsional, default 800).
     * @var int|null
     */
    // protected $imageWidth = 800;

    /**
     * Tinggi gambar maksimum setelah resize.
     * Definisikan ini di Controller (opsional, default 800).
     * @var int|null
     */
    // protected $imageHeight = 800;

    /**
     * Kualitas gambar setelah encode (0-100). Hanya berlaku untuk format lossy seperti JPEG, WEBP.
     * Definisikan ini di Controller (opsional, default 80).
     * @var int|null
     */
    // protected $imageQuality = 80;

    /**
     * Menghasilkan aturan validasi dasar untuk gambar.
     * Gunakan $this->imageFieldName yang didefinisikan di Controller.
     *
     * @return array
     */
    protected function imageValidationRules(): array
    {
        if (!property_exists($this, 'imageFieldName')) {
            throw new Exception('Property $imageFieldName must be defined in the class using HandlesImageUploads trait.');
        }
        return [
            $this->imageFieldName => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5000' // Max 5MB
        ];
    }

    /**
     * Proses upload, optimasi, dan simpan gambar ke S3 menggunakan Intervention Image v3.
     *
     * @param UploadedFile $image Instance file yang diupload.
     * @param string|null $directory Direktori spesifik di S3 (override default jika perlu).
     * @param string $visibility Visibilitas file di S3 ('public' atau 'private'). Default 'public'.
     * @return string Path relatif file yang disimpan di S3.
     * @throws Exception Jika gagal memproses atau menyimpan.
     */
    protected function processAndStoreImage(UploadedFile $image, string $directory = null, string $visibility = 'public'): string
    {
        $directory = $directory ?: ($this->imageDirectory ?? 'uploads');
        $quality = $this->imageQuality ?? 80;

        try {
            // Generate nama file aman
            $originalExtension = strtolower($image->getClientOriginalExtension());
            $filename = Str::slug(pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME))
                        . '_' . uniqid()
                        . '.' . $originalExtension;

            // Format path
            $path = "{$directory}/{$filename}";

            // Log singkat
            Log::info('Mulai upload gambar ke S3', [
                'path' => $path,
                'size' => $image->getSize()
            ]);

            // Baca dan proses gambar menggunakan Intervention Image
            $img = Image::read($image);
            
            // Proses gambar jika ukuran ditetapkan
            if (isset($this->imageWidth) || isset($this->imageHeight)) {
                $width = $this->imageWidth ?? null;
                $height = $this->imageHeight ?? null;
                $img = $img->resize(width: $width, height: $height);
            }
            
            // Encode gambar berdasarkan format
            $encodedImage = match ($originalExtension) {
                'jpeg', 'jpg' => $img->toJpeg($quality),
                'png' => $img->toPng(),
                'gif' => $img->toGif(),
                'webp' => $img->toWebp($quality),
                default => $img->toJpeg($quality),
            };

            // Upload ke S3
            $uploadSuccess = Storage::disk('s3')->put(
                $path, 
                (string)$encodedImage, 
                ['ContentType' => $image->getMimeType()]
            );
            
            if (!$uploadSuccess) {
                throw new Exception("Upload gambar gagal");
            }
            
            // Dapatkan URL dari S3
            $fileUrl = Storage::disk('s3')->url($path);
            
            Log::info('Upload berhasil ke S3', [
                'path' => $path,
                'url' => $fileUrl
            ]);
            
            return $path;

        } catch (Exception $e) {
            Log::error("Upload error: " . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            throw new Exception("Gagal upload gambar: " . $e->getMessage());
        }
    }

    /**
     * Hapus gambar lama dari S3.
     * (Tidak ada perubahan di sini)
     * @param string|null $path Path relatif file di S3 yang akan dihapus.
     * @return void
     */
    protected function deleteOldImage(?string $path): void
    {
        if (!$path) {
            return;
        }
        try {
            if (Storage::disk('s3')->exists($path)) {
                Storage::disk('s3')->delete($path);
            }
        } catch (Exception $e) {
            Log::error("Failed to delete old image from S3: {$path}. Error: " . $e->getMessage());
        }
    }

     /**
      * Mendapatkan URL publik untuk gambar
      *
      * @param string|null $path Path relatif file di S3
      * @return string|null URL gambar atau null jika path tidak ada
      */
     protected function getImageUrl(?string $path, int $minutes = 5): ?string
     {
         if (!$path) {
             return null;
         }

         try {
             return Storage::disk('s3')->url($path);
         } catch (Exception $e) {
             Log::error("Gagal mendapatkan URL gambar: {$path}. Error: " . $e->getMessage());
             return null;
         }
     }

    /**
     * Upload gambar ke storage
     *
     * @param UploadedFile $image
     * @param string $path
     * @param string|null $oldImage Path gambar lama untuk dihapus
     * @return string
     */
    public function uploadImage(UploadedFile $image, string $path, ?string $oldImage = null): string
    {
        // Hapus gambar lama jika ada
        if ($oldImage) {
            Storage::disk('s3')->delete($oldImage);
        }
        
        // Upload gambar baru
        return $image->store($path, 's3');
    }
    
    /**
     * Hapus gambar dari storage
     *
     * @param string|null $imagePath
     * @return bool
     */
    public function deleteImage(?string $imagePath): bool
    {
        if ($imagePath) {
            return Storage::disk('s3')->delete($imagePath);
        }
        
        return false;
    }
}