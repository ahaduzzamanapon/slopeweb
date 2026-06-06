<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatalogueDownload extends Model
{
    protected $fillable = ['name', 'phone', 'product_id'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
