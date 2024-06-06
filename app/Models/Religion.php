<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Religion extends Model
{
    use \Sushi\Sushi;
    protected $rows = [
        [
            'id' => 1,
            'name' => 'Islam',
        ],
        [
            'id' => 2,
            'name' => 'Katolik',
        ],
        [
            'id' => 3,
            'name' => 'Kristen',
        ],
        [
            'id' => 4,
            'name' => 'Hindu',
        ],
        [
            'id' => 5,
            'name' => 'Buddha',
        ],
        [
            'id' => 6,
            'name' => 'Konghucu',
        ],
    ];
}
