<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LastEducation extends Model
{
    use \Sushi\Sushi;
    protected $rows = [
        [
            'id' => 1,
            'name' => 'Tidak Bersekolah'
        ],
        [
            'id' => 2,
            'name' => 'KB'
        ],
        [
            'id' => 3,
            'name' => 'TK'
        ],
        [
            'id' => 4,
            'name' => 'SD'
        ],
        [
            'id' => 5,
            'name' => 'SMP'
        ],
        [
            'id' => 6,
            'name' => 'SMA'
        ],
        [
            'id' => 7,
            'name' => 'Perguruan Tinggi'
        ]
    ];
}
