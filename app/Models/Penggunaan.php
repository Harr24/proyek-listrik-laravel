<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penggunaan extends Model
{
    use HasFactory;

    protected $table = 'penggunaans';
    protected $primaryKey = 'id_penggunaan';

    protected $fillable = [
        'id_pelanggan',
        'bulan',
        'tahun',
        'meter_awal',
        'meter_akhir',
    ];

    /**
     * Mendapatkan data pelanggan yang terkait dengan penggunaan ini.
     */
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan', 'id_pelanggan');
    }

    // TAMBAHAN BARU: Relasi one-to-one ke model Tagihan
    public function tagihan()
    {
        return $this->hasOne(Tagihan::class, 'id_penggunaan', 'id_penggunaan');
    }
}
