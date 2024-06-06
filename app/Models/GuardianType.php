<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GuardianType extends Model
{
    use \Sushi\Sushi;
    protected $rows = [
        [
            'id' => 1,
            'name' => 'Ayah',
        ],
        [
            'id' => 2,
            'name' => 'Ibu',
        ],
        [
            'id' => 3,
            'name' => 'Wali',
        ]
    ];
}
