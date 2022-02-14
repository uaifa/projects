<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;


    protected $table = 'clients';
    protected $primaryKey = 'id';
    
    protected $fillable = [
                    'company',
                    'first_name',
                    'last_name',
                    'email',
                    'street',
                    'house_no',
                    'zip_code',
                    'town',
                    'telephone',
                    'branch',
                    'created_by',
                    'status',
                    'additional_address',
                    'corporate_client',
                    'customer_name',
                    'latitude',
                    'longitude',

                    
        ];


    protected $with = ['ContactPerson'];

    protected $appends = ['encoded_id'];

    public function getEncodedIdAttribute(){
        return base64_encode($this->id);
    }
    
    public function ContactPerson(){
        return $this->hasMany(ContactPerson::class, 'client_id', 'id');
    }
}
