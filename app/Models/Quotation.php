<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    protected $fillable = [
        'title',
        'file_path',
        'ref_id',
        'client_name',
        'client_address',
        'client_phone',
        'prepared_by',
        'status',
        'total_amount',
    ];
}
