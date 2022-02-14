<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $table = 'packages';
    protected $primaryKey = 'id';

    protected $fillable = [
            'title',
            'heading',
            'sub_heading',
            'package_name',
            'currency',
            'package_type_text',
            'storage_place_size',
            'duration',
            'icon',
            'price',
            'manager',
            'users',
            'support_text',
            'storage_text',
            'button_text',
            'created_by',
            'slug',
            'stripe_plan',
            'description',
            'paypal_plan',
            
        ];

    protected $appends = ['encoded_id'];

    public function getEncodedIdAttribute(){
        return base64_encode($this->id);
    }

    public function user(){
        return $this->belongsTo(User::class, 'created_by');
    }

}
