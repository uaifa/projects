<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    use HasFactory;


    protected $table = 'places';
    protected $primaryKey = 'id';
    
    protected $fillable = [
                    'job_title',
                    'distance',
                    'client_id',
                    'description',
                    'scheduled',
                    'assign_to',
                    'status',
                    'created_by',
        ];

    protected $appends = ['encoded_id'];

    protected $with = ['clients'];


    public function getEncodedIdAttribute(){
        return base64_encode($this->id);
    }

    public function clients(){
        return $this->hasOne(Client::class, 'id','client_id');
    }
}
