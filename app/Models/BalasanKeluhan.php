<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BalasanKeluhan extends Model
{
    use HasFactory;

    protected $fillable = ['keluhan_id', 'user_id', 'pesan', 'gambar'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function keluhan()
    {
        return $this->belongsTo(Keluhan::class);
    }
}
