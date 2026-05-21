<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detailSale extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    
    public function sparepartSale()
    {
        return $this->belongsTo(sparepartSale::class, 'sparepart_sales_id');
    }
    public function sparepart()
    {
        return $this->belongsTo(sparepart::class);
    }
}
