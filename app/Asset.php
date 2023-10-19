<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    public $table = 'assets';

    protected $fillable = [
        'name',
        'id_jenis_obat',
        'expired_at',
        'created_at',
        'updated_at',
        'description',
    ];

    public function jenisObat()
    {
        return $this->belongsTo(JenisObat::class, 'id_jenis_obat', 'id');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'asset_id');
    }

    // Asset.php

    public function getBarcodeContentAttribute()
    {
        // Menggunakan nama aset sebagai konten barcode, Anda bisa sesuaikan dengan kebutuhan Anda
        return $this->attributes['name'];
    }
}
