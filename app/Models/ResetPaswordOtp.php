<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResetPaswordOtp extends Model
{
    use HasFactory;

    protected $table = 'reset_pasword_otps';
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
