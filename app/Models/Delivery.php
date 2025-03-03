<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Delivery extends Model
{
    use HasUuids,HasFactory,SoftDeletes;

    protected $fillable = [
        'user_id',
        'package_id',
        'status',
    ];

    //relasi dengan paket
    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    //ini relasi dengan user
    public function kurir()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
