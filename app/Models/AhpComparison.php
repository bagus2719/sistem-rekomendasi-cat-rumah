<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AhpComparison extends Model
{
    use HasFactory;

    protected $table = 'perbandingan_ahp';
    protected $guarded = [];

    public function criteria1()
    {
        return $this->belongsTo(Criteria::class, 'kriteria_1_id');
    }

    public function criteria2()
    {
        return $this->belongsTo(Criteria::class, 'kriteria_2_id');
    }
}
