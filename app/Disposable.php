<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Disposable extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'disposables';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
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


    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'disposable_id');
    }

    // Asset.php

    public function getBarcodeContentAttribute()
    {
        // Menggunakan nama aset sebagai konten barcode, Anda bisa sesuaikan dengan kebutuhan Anda
        return $this->attributes['name'];
    }

}
