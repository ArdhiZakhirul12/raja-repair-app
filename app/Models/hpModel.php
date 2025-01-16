<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hpModel extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function booking()
    {
        return $this->hasMany(booking::class);
    }
    public function hpMerk()
    {
        return $this->belongsTo(hpMerk::class);
    }
}
