<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;


    protected $table = 'teams';
    protected $primaryKey = 'id';

    protected $fillable = [
            'name',
            'description',
            'address',
            'city',
            'country',
            'zip_code',
            'status',
            'created_by',
        ];

    protected $appends = ['encoded_id'];

    protected $with = ['skills'];

    public function getEncodedIdAttribute(){
        return base64_encode($this->id);
    }
    
    public function StaffMembers(){
        return $this->belongsToMany(StaffMembers::class, 'staff_members_teams', 'team_id', 'staff_member_id');
    }

    public function users(){
        return $this->belongsToMany(User::class,  'users_teams', 'team_id', 'user_id');

    }

    public function skills(){
        return $this->belongsToMany(Skill::class, 'teams_skills', 'team_id', 'skill_id');
    }
}
