<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    protected $table = 'riwayat';
    protected $guarded = [];

    protected $casts = [
        'input_data' => 'array',
        'hasil_rekomendasi' => 'array',
    ];
}
