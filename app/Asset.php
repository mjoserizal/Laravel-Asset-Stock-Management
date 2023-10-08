<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Asset extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'assets';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'id_jenis_obat',
        'expired_at',
        'created_at',
        'updated_at',
        'deleted_at',
        'description',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }


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
