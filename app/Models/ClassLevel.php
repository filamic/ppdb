<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassLevel extends Model
{
    use \Sushi\Sushi;
    protected $rows = [
        [
            'id' => 1,
            'name' => 'KB Basic Batam Center',
            'long_name' => 'Kelompok Bermain Basic Batam Center',
        ],
        [
            'id' => 2,
            'name' => 'KB Basic Batu Aji',
            'long_name' => 'Kelompok Bermain Basic Batu Aji',
        ],
        [
            'id' => 3,
            'name' => 'TK Basic Batam Center',
            'long_name' => 'Taman Kanak-Kanak Basic Batam Center',
        ],
        [
            'id' => 4,
            'name' => 'TK Basic Batu Aji',
            'long_name' => 'Taman Kanak-Kanak Basic Batu Aji',
        ],
        [
            'id' => 5,
            'name' => 'SD Basic Batam Center',
            'long_name' => 'Sekolah Dasar Basic Batam Center',
        ],
        [
            'id' => 6,
            'name' => 'SD Basic Batu Aji',
            'long_name' => 'Sekolah Dasar Basic Batu Aji',
        ],
        [
            'id' => 7,
            'name' => 'SMP Basic Batam Center',
            'long_name' => 'Sekolah Menengah Pertama Basic Batam Center',
        ],
        [
            'id' => 8,
            'name' => 'SMP Basic Batu Aji',
            'long_name' => 'Sekolah Menengah Pertama Basic Batu Aji',
        ],
        [
            'id' => 9,
            'name' => 'SMA Basic Batam Center',
            'long_name' => 'Sekolah Menengah Atas Basic Batam Center',
        ],
        [
            'id' => 10,
            'name' => 'SMA Basic Batu Aji',
            'long_name' => 'Sekolah Menengah Atas Basic Batu Aji',
        ]
    ];
}
