<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Package extends Model
{
    use HasUuids,SoftDeletes,HasFactory;

    protected $fillable = [
        'id',
        'tracking_number',
        'sender_id',
        'receiver_id',
        'receiver_name',
        'receiver_address',
        'receiver_phone',
        'weight',
        'status'
    ];
    public function deliveries()
    {
        return $this->hasMany(Delivery::class);
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}
