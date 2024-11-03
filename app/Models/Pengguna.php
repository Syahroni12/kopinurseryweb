<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengguna extends Model
{
    use HasFactory;

    protected $table = 'penggunas';
    protected $guarded = 'id';

    public function user(){
        return $this->belongsTo(User::class,'id_user','id');
    }
    public function Blog(){
        return $this->hasMany(Blog::class,'id_pengguna','id');
    }
}
