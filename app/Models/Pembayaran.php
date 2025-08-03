<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayarans';
    protected $primaryKey = 'id_pembayaran';

    protected $fillable = [
        'id_tagihan',
        'tanggal_bayar',
        'biaya_admin',
        'total_akhir',
        'bukti_pembayaran',
    ];

    /**
     * Mendapatkan data tagihan yang terkait dengan pembayaran ini.
     */
    public function tagihan()
    {
        return $this->belongsTo(Tagihan::class, 'id_tagihan', 'id_tagihan');
    }
}
