<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'stripe_plan',
        'cost',
        'description'
    ];

    protected $appends = ['encoded_id'];

    public function getEncodedIdAttribute(){
        return base64_encode($this->id);
    }

    
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
