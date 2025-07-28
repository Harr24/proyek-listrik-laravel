<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarif extends Model
{
    use HasFactory;

    /**
     * Nama tabel (opsional, jika bukan plural dari nama model)
     */
    protected $table = 'tarifs';

    /**
     * Nama kolom primary key.
     */
    protected $primaryKey = 'id_tarif';

    /**
     * Menentukan apakah primary key bertipe auto-increment.
     */
    public $incrementing = true;

    /**
     * Menentukan tipe data primary key ('int' atau 'string').
     */
    protected $keyType = 'int';

    /**
     * Kolom-kolom yang boleh diisi secara massal.
     */
    protected $fillable = [
        'daya',
        'tarif_per_kwh',
    ];

    /**
     * Agar route model binding menggunakan 'id_tarif' sebagai key.
     */
    public function getRouteKeyName()
    {
        return 'id_tarif';
    }
}
