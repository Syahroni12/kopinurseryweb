<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $table = 'blogs';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    public function pengguna(){
        return $this->belongsTo(Pengguna::class,'id_pengguna','id');
    }

}
