<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    /**
     * Nama tabel (opsional, jika bukan plural dari nama model)
     */
    protected $table = 'pelanggans';

    /**
     * Nama kolom primary key.
     */
    protected $primaryKey = 'id_pelanggan';

    /**
     * Kolom-kolom yang boleh diisi secara massal.
     */
    protected $fillable = [
        'id_tarif',
        'nomor_meter',
        'nama_pelanggan',
        'alamat',
    ];

    /**
     * Mendapatkan data tarif yang dimiliki oleh pelanggan (Relasi BelongsTo).
     */
    public function tarif()
    {
        return $this->belongsTo(Tarif::class, 'id_tarif', 'id_tarif');
    }
}
