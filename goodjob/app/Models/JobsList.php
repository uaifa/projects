<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobsList extends Model
{
    use HasFactory;

    protected $table = 'jobs_lists';
    protected $primaryKey = 'id';
    
    protected $fillable = [
                    'name',
                    'status',
                    'description',
                    'date',
                    'from_time_hours',
                    'to_time_minutes',
                    'client_id',
                    'place_of_work',
                    'contact_person',
                    'phone',
                    'email',
                    'created_by',
                    'signature',
                    'role_id',
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
