<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rating extends Model
{
    use HasFactory;
    protected $casts = [
        'rating' => 'integer',
    ];
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function booking()
    {
        return $this->belongsTo(booking::class);
    }


}
