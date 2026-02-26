<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kisi extends Model
{
    protected $table = 'kisiler';

    protected $fillable = ['ad', 'soyad', 'yas'];
}
