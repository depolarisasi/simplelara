@extends('layouts.admin.app')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h3>Hasil Debug Upload Gambar</h3>
            <a href="{{ route('administrator.debug.index') }}" class="btn btn-light">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
        
        <div class="card-body">
            <div class="mb-4">
                <h4 class="border-bottom pb-2">Status Upload</h4>
                @if(isset($debug['error']))
                    <div class="alert alert-danger">
                        <h5><i class="fas fa-exclamation-triangle"></i> Terjadi Error!</h5>
                        <p><strong>Pesan Error:</strong> {{ $debug['error']['message'] }}</p>
                    </div>
                @elseif(isset($debug['upload_result']) && $debug['upload_result'])
                    <div class="alert alert-success">
                        <h5><i class="fas fa-check-circle"></i> Upload Berhasil!</h5>
                        <p><strong>Path:</strong> {{ $debug['upload_result']['path'] }}</p>
                        @if(isset($debug['upload_result']['url']) && $debug['upload_result']['url'])
                            <a href="{{ $debug['upload_result']['url'] }}" target="_blank" class="btn btn-sm btn-primary">
                                <i class="fas fa-external-link-alt"></i> Lihat Gambar
                            </a>
                        @endif
                    </div>
                @else
                    <div class="alert alert-warning">
                        <h5><i class="fas fa-exclamation-circle"></i> Tidak Ada Gambar</h5>
                        <p>Tidak ada file gambar yang diupload atau diproses.</p>
                    </div>
                @endif
            </div>
            
            <!-- Proses Log -->
            <div class="mb-4">
                <h4 class="border-bottom pb-2">Log Proses</h4>
                <div class="bg-light p-3 border rounded">
                    @forelse($debug['process_log'] as $log)
                        <div class="log-entry">
                            <i class="fas fa-angle-right text-primary"></i> {{ $log }}
                        </div>
                    @empty
                        <p class="text-muted">Tidak ada log proses.</p>
                    @endforelse
                </div>
            </div>
            
            <!-- Detail File -->
            @if(!empty($debug['files_data']))
                <div class="mb-4">
                    <h4 class="border-bottom pb-2">Detail File</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th width="30%">Nama File Asli</th>
                                    <td>{{ $debug['files_data']['original_name'] }}</td>
                                </tr>
                                <tr>
                                    <th>Ekstensi</th>
                                    <td>{{ $debug['files_data']['original_extension'] }}</td>
                                </tr>
                                <tr>
                                    <th>MIME Type</th>
                                    <td>{{ $debug['files_data']['mime_type'] }}</td>
                                </tr>
                                <tr>
                                    <th>Ukuran</th>
                                    <td>{{ number_format($debug['files_data']['size'] / 1024, 2) }} KB</td>
                                </tr>
                                <tr>
                                    <th>Valid</th>
                                    <td>
                                        @if($debug['files_data']['is_valid'])
                                            <span class="badge bg-success">Ya</span>
                                        @else
                                            <span class="badge bg-danger">Tidak</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Kode Error</th>
                                    <td>{{ $debug['files_data']['error_code'] }} 
                                        @if($debug['files_data']['error_code'] == 0)
                                            <span class="badge bg-success">OK</span>
                                        @else
                                            <span class="badge bg-danger">Error</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Path Sementara</th>
                                    <td><code>{{ $debug['files_data']['temp_path'] ?? 'Tidak tersedia' }}</code></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
            
            <!-- Request Data -->
            <div class="mb-4">
                <h4 class="border-bottom pb-2">Data Request</h4>
                <div class="bg-light p-3 border rounded">
                    <pre class="mb-0"><code>{{ json_encode($debug['request_data'], JSON_PRETTY_PRINT) }}</code></pre>
                </div>
            </div>
            
            <!-- Error Stack Trace -->
            @if(isset($debug['error']) && isset($debug['error']['stack_trace']))
                <div class="mb-4">
                    <h4 class="border-bottom pb-2 text-danger">Stack Trace</h4>
                    <div class="bg-light p-3 border rounded overflow-auto" style="max-height: 400px;">
                        <pre class="mb-0"><code>{{ $debug['error']['stack_trace'] }}</code></pre>
                    </div>
                </div>
            @endif
            
            <!-- Tips Debugging -->
            <div class="card bg-light border-info mt-4">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0"><i class="fas fa-lightbulb"></i> Tips Debugging</h5>
                </div>
                <div class="card-body">
                    <ul class="mb-0">
                        <li>Periksa nilai-nilai konfigurasi PHP untuk upload file (Max Upload Size, dll)</li>
                        <li>Pastikan direktori penyimpanan (<code>storage/app/public</code>) memiliki izin yang benar</li>
                        <li>Periksa konfigurasi Amazon S3 di file <code>.env</code> jika menggunakan penyimpanan S3</li>
                        <li>Check Laravel logs di <code>storage/logs/laravel.log</code> untuk informasi error tambahan</li>
                        <li>Pastikan <code>php-gd</code> atau <code>php-imagick</code> terinstal untuk manipulasi gambar</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .log-entry {
        padding: 5px 0;
        border-bottom: 1px dashed #ddd;
    }
    .log-entry:last-child {
        border-bottom: none;
    }
    pre {
        white-space: pre-wrap;
    }
</style>
@endpush 