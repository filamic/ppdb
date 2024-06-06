<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sex extends Model
{
    use \Sushi\Sushi;
    protected $rows = [
        [
            'id' => 1,
            'name' => 'Laki-Laki',
            'img' => '/img/male.png',
        ],
        [
            'id' => 2,
            'name' => 'Perempuan',
            'img' => '/img/female.png',
        ]
    ];
}
