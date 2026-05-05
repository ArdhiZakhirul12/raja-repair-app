<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pembayaranBooking extends Model
{
    use HasFactory;
     protected $guarded = ['id'];

    public function booking()
    {
        return $this->belongsTo(booking::class);
    }
    public function metodePembayaran()
    {
        return $this->belongsTo(metodePembayaran::class);
    }
}
