<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    use HasFactory;
    
    protected $table = 'kriteria';
    protected $guarded = [];

    public function alternativeValues()
    {
        return $this->hasMany(AlternativeValue::class, 'kriteria_id');
    }

    public function subKriteria()
    {
        return $this->hasMany(SubKriteria::class, 'kriteria_id');
    }
}
