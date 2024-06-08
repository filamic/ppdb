<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttachmentType extends Model
{
    use \Sushi\Sushi;
    protected $rows = [
        [
            'id' => 1,
            'name' => 'Kartu Keluarga',
        ],
        [
            'id' => 2,
            'name' => 'Akta Lahir Anak',
        ],
        [
            'id' => 3,
            'name' => 'KTP',
        ]
    ];

}
