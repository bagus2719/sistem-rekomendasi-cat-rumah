<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlternativeValue extends Model
{
    use HasFactory;
    
    protected $table = 'nilai_alternatif';
    protected $guarded = [];

    public function alternative()
    {
        return $this->belongsTo(Alternative::class, 'alternatif_id');
    }

    public function criteria()
    {
        return $this->belongsTo(Criteria::class, 'kriteria_id');
    }
}
