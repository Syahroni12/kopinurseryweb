<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monicontrolling extends Model
{
    use HasFactory;
    protected $table = 'monicontrollings';
    protected $guarded = ['id'];


    public function alat()
    {
        return $this->belongsTo(Alat::class, 'id_alat', 'id');
    }
}
