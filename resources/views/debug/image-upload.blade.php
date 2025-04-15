@extends('layouts.admin.app')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-info text-white">
            <h3>Debug Upload Gambar</h3>
        </div>
        
        <div class="card-body">
            <div class="alert alert-info">
                <h5>Panduan Debugging Upload Gambar</h5>
                <p>Form ini akan membantu mendiagnosis masalah upload gambar menggunakan trait HandlesImageUploads.</p>
                <ul>
                    <li>Pilih sebuah gambar untuk diupload</li>
                    <li>Hasil debug akan menampilkan semua informasi tentang proses upload</li>
                    <li>Semua log juga akan disimpan di file Laravel log untuk analisis lebih lanjut</li>
                </ul>
            </div>
            
            @if ($errors->any())
                <div class="alert alert-danger">
                    <h5>Terjadi Error Validasi:</h5>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <form action="{{ route('administrator.debug.upload') }}" method="POST" enctype="multipart/form-data" class="mb-4">
                @csrf
                
                <div class="mb-3">
                    <label for="debug_image" class="form-label fw-bold">Pilih Gambar untuk Diupload:</label>
                    <input type="file" name="debug_image" id="debug_image" class="form-control @error('debug_image') is-invalid @enderror">
                    @error('debug_image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text">Format: JPG, PNG, GIF, WEBP | Maks: 5MB</div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold">Pilih Jenis Penyimpanan:</label>
                    <div class="d-flex gap-3">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="storage_type" id="storage_local" value="local" checked>
                            <label class="form-check-label" for="storage_local">
                                Storage Lokal
                                <span class="badge bg-success ms-1">Disarankan untuk Debugging</span>
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="storage_type" id="storage_s3" value="s3" {{ !$storage_info['s3_enabled'] ? 'disabled' : '' }}>
                            <label class="form-check-label" for="storage_s3">
                                Amazon S3
                                @if(!$storage_info['s3_enabled'])
                                    <span class="badge bg-danger ms-1">Konfigurasi S3 tidak lengkap</span>
                                @endif
                            </label>
                        </div>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="notes" class="form-label">Catatan (Opsional):</label>
                    <textarea name="notes" id="notes" class="form-control">{{ old('notes') }}</textarea>
                </div>
                
                <hr>
                
                <div class="d-flex">
                    <button type="submit" class="btn btn-primary me-2">
                        <i class="fas fa-upload"></i> Upload & Debug
                    </button>
                    <a href="{{ route('administrator.debug.index') }}" class="btn btn-secondary">
                        <i class="fas fa-redo"></i> Reset
                    </a>
                </div>
            </form>
            
            <div class="card">
                <div class="card-header bg-secondary text-white">
                    Environment Info
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <h6>PHP Info:</h6>
                            <ul class="list-unstyled">
                                <li><strong>PHP Version:</strong> {{ phpversion() }}</li>
                                <li><strong>Max Upload Size:</strong> {{ ini_get('upload_max_filesize') }}</li>
                                <li><strong>Post Max Size:</strong> {{ ini_get('post_max_size') }}</li>
                                <li><strong>Memory Limit:</strong> {{ ini_get('memory_limit') }}</li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <h6>Laravel Info:</h6>
                            <ul class="list-unstyled">
                                <li><strong>Laravel Version:</strong> {{ app()->version() }}</li>
                                <li><strong>Environment:</strong> {{ app()->environment() }}</li>
                                <li><strong>Debug Mode:</strong> {{ config('app.debug') ? 'ON' : 'OFF' }}</li>
                                <li>
                                    <strong>Storage Link:</strong> 
                                    @if($storage_info['storage_link_exists'])
                                        <span class="badge bg-success">Terpasang</span>
                                    @else
                                        <span class="badge bg-danger">Tidak ada</span>
                                        <small class="d-block text-danger">Jalankan: php artisan storage:link</small>
                                    @endif
                                </li>
                                <li>
                                    <strong>Public Storage Writeable:</strong>
                                    @if($storage_info['public_writeable'])
                                        <span class="badge bg-success">Ya</span>
                                    @else
                                        <span class="badge bg-danger">Tidak</span>
                                    @endif
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <h6>Storage Info:</h6>
                            <ul class="list-unstyled">
                                <li><strong>Default Disk:</strong> {{ $storage_info['default_disk'] }}</li>
                                <li>
                                    <strong>S3 Konfigurasi:</strong>
                                    @if($storage_info['s3_enabled'])
                                        <span class="badge bg-success">Terkonfigurasi</span>
                                    @else
                                        <span class="badge bg-warning">Tidak lengkap</span>
                                    @endif
                                </li> 
                                    <li><strong>S3 Bucket:</strong> {{ $storage_info['s3_bucket'] }}</li>
                                    <li><strong>S3 URL:</strong> {{ $storage_info['s3_url'] ?: 'Tidak dikonfigurasi' }}</li>
                                
                                <li>
                                    <strong>Image Libraries:</strong><br>
                                    GD: <span class="badge bg-{{ $storage_info['driver_info']['gd'] === 'Installed' ? 'success' : 'danger' }}">{{ $storage_info['driver_info']['gd'] }}</span><br>
                                    Imagick: <span class="badge bg-{{ $storage_info['driver_info']['imagick'] === 'Installed' ? 'success' : 'warning' }}">{{ $storage_info['driver_info']['imagick'] }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 