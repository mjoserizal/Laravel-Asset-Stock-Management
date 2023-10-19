<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Alat extends Model
{
    use  HasFactory;

    public $table = 'alats';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'created_at',
        'updated_at',
        'deleted_at',
        'description',
        'keterangan',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }


    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'alat_id');
    }

    // Asset.php

    public function getBarcodeContentAttribute()
    {
        // Menggunakan nama aset sebagai konten barcode, Anda bisa sesuaikan dengan kebutuhan Anda
        return $this->attributes['name'];
    }

}
