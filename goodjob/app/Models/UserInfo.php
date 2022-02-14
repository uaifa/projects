<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    use HasFactory;

    protected $table = 'user_infos';
    protected $primaryKey = 'id';

    protected $fillable = [
            'house_no',
            'zip_code',
            'city',
            'country',
            'phone',
            'mobile',
            'private_address',
            'user_id',
        ];

    protected $appends = ['encoded_id'];

    public function getEncodedIdAttribute(){
        return base64_encode($this->id);
    }
}
