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
            'icon' => 'Menunggu heroicon-m-',
            'color' => 'warning',
        ],
        [
            'id' => 2,
            'name' => 'Datang untuk Tes Lisan dan Tertulis',
            'icon' => 'Datang untuk Tes Lisan dan heroicon-m-',
            'color' => 'info',
        ],
        [
            'id' => 3,
            'name' => 'Penyerahan Berkas ke Sekolah',
            'icon' => 'Penyerahan Berkas ke heroicon-m-',
            'color' => 'info',
        ],
        [
            'id' => 4,
            'name' => 'Selesai (Diterima)',
            'icon' => 'Selesai (Diterimaheroicon-m-',
            'color' => 'success',
        ],
        [
            'id' => 5,
            'name' => 'Berkas Kurang',
            'icon' => 'Berkas heroicon-m-',
            'color' => 'warning',
        ],
        [
            'id' => 6,
            'name' => 'Ditolak',
            'icon' => 'heroicon-m-',
            'color' => 'gray',
        ],
    ];
}
