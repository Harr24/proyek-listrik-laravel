<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terhubung dengan model ini.
     */
    protected $table = 'pelanggans';

    /**
     * Nama kolom primary key.
     */
    protected $primaryKey = 'id_pelanggan';

    /**
     * Kolom-kolom yang boleh diisi secara massal (mass assignable).
     */
    protected $fillable = [
        'user_id', // <-- TAMBAHAN BARU
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

    /**
     * Mendapatkan data user yang memiliki data pelanggan ini (Relasi BelongsTo).
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
