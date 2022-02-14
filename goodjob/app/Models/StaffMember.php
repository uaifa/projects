<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffMember extends Model
{
    use HasFactory;

    protected $table = 'staff_members';
    protected $primaryKey = 'id';

    protected $fillable = [
            'first_name',
            'last_name',
            'email',
            'phone_number_1',
            'phone_number_2',
            'profile_image',
            'employee_id',
            'profile_background_image',
            'status',
            'phone_number',
            'mobile_number',
            'private_address',
            'house_number',
            'zip_code',
            'city',
            'country',
        ];

    protected $with = ['teams'];
    
    protected $appends = ['encoded_id'];

    public function getEncodedIdAttribute(){
        return base64_encode($this->id);
    }
    
    public function teams(){
        return $this->belongsToMany(Team::class, 'staff_members_teams', 'team_id', 'staff_member_id');
    }
}
