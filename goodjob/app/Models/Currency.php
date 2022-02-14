<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    protected $table = 'currencies';
    protected $primaryKey = 'id';

    protected $fillable = [

            'name',
            'code',
            'symbol',
            'precision',
            'thousand_separator',
            'decimal_separator',
            'swap_currency_symbol',
            'exchange_rate',
            
    ];
}
