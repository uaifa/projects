<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transactions';
    protected $primaryKey = 'id';

    protected $fillable = [
                'customer_name',
                'customer_email',
                'item_name',
                'item_number',
                'item_price',
                'item_price_currency',
                'paid_amount',
                'paid_amount_currency',
                'txn_id',
                'payment_status',
                'stripe_checkout_session_id',
                'created',
                'modified',
	        'user_id',
                'payment_type',
                'payer_id',
                'payer_status',
                'payment_state',
                'payment_id',
                'created',
                'modified',
        ];
    
}
