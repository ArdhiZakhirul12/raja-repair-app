<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class booking extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function customer()
    {
        return $this->belongsTo(customer::class);
    }
    public function teknisi()
    {
        return $this->belongsTo(teknisi::class);
    }
    public function hpModel()
    {
        return $this->belongsTo(hpModel::class);
    }
    public function metodePembayaran()
    {
        return $this->belongsTo(metodePembayaran::class);
    }
    public function sparepart_booking()
    {
        return $this->hasMany(sparepart_booking::class);
    }
    public function workTimeBooking()
    {
        return $this->hasOne(workTimeBooking::class);

    }
    public function pengeluaran()
    {
        return $this->hasOne(pengeluaran::class);

    }
    public function detailBooking()
    {
        return $this->hasMany(detailBooking::class);
    }
    public function claimGaransi()
    {
        return $this->hasMany(claimGaransi::class);
    }
    


    





}
