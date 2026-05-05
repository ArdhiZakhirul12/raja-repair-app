<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class teknisi extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function cabang()
    {
        return $this->belongsTo(cabang::class);
    }
    public function booking()
    {
        return $this->hasMany(hpMerk::class);
    }
}
