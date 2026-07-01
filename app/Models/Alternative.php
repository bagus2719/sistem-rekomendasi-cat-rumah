<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alternative extends Model
{
    use HasFactory;
    
    protected $table = 'alternatif';
    protected $guarded = [];

    public function values()
    {
        return $this->hasMany(AlternativeValue::class, 'alternatif_id');
    }
}
