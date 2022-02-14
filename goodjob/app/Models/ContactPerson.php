<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactPerson extends Model
{
    use HasFactory;

    protected $table = 'contact_persons';
    protected $primaryKey = 'id';

    protected $fillable = [
            'name',
            'email',
            'phone_number',
            'functions',
            'client_id',
            'status',
            'created_by'
        ];
}
