<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VerificationStatus extends Model
{
    use \Sushi\Sushi;
    protected $rows = [
        [
            'id' => 1,
            'name' => 'Menunggu Verifikasi',
            'icon' => 'heroicon-m-arrow-path',
            'color' => 'warning',
        ],
        [
            'id' => 2,
            'name' => 'Datang untuk Tes Lisan dan Tertulis',
            'icon' => 'heroicon-m-computer-desktop',
            'color' => 'info',
        ],
        [
            'id' => 3,
            'name' => 'Penyerahan Berkas ke Sekolah',
            'icon' => 'heroicon-m-clipboard-document-list',
            'color' => 'info',
        ],
        [
            'id' => 4,
            'name' => 'Selesai (Diterima)',
            'icon' => 'heroicon-m-check-badge',
            'color' => 'success',
        ],
        [
            'id' => 5,
            'name' => 'Berkas Kurang',
            'icon' => 'heroicon-m-exclamation-circle',
            'color' => 'warning',
        ],
        [
            'id' => 6,
            'name' => 'Ditolak',
            'icon' => 'heroicon-m-x-circle',
            'color' => 'gray',
        ],
    ];
}
