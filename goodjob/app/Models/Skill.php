<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;


    protected $table = 'skills';
    protected $primaryKey = 'id';

    protected $fillable = [
            'name',
            'description',
            'status',
            'created_by',
        ];

    protected $appends = ['encoded_id'];

    public function getEncodedIdAttribute(){
        return base64_encode($this->id);
    }
    
    public function teams(){
        return $this->belongsToMany(Team::class, 'teams_skills', 'team_id', 'skill_id');
    }
}
