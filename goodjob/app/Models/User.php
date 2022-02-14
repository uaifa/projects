<?php

namespace App\Models;

use App\Events\WelcomeMail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Cashier\Billable;




class User extends Authenticatable
{
    use Billable;
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'first_name',
        'last_name',
        'name',
        'email',
        'password',
        'avatar', 
        'provider_id', 
        'provider',
        'access_token',
        'role_id',
        'payment_status',
        'package_type',
        'current_subscription_start',
        'current_subscription_end',
        'stripe_payment_status',
        'payment_stripe_status',
        'payment_paypal_status',
        'stripe_start_date',
        'stripe_end_date',
        'paypal_start_date',
        'paypal_end_date',
        'package_start_date_time',
        'payment_type',
        'package_end_date_time',
        'private_address',
        'house_number',
        'zip_code', 
        'city',
        'country',
        'phone_number',
        'mobile_number',
        'user_type',
        'profile_image',
        
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $dispatchesEvents = [

        // "created" => WelcomeMail::class,
    ]; 

    protected $appends = ['encoded_id'];

    public function getEncodedIdAttribute(){
        return base64_encode($this->id);
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'post_id');
    }

    public function favouritPosts()
    {
        return $this->hasMany(Post::class, 'post_favourit');
    }

    public function blockedUsers()
    {
        return $this->hasMany(User::class, 'block_users', 'blocker_id');
    }

    public function tagedPosts()
    {
        return $this->hasMany(Post::class, 'post_id', 'user_id');
    }

    public function teams(){
        return $this->belongsToMany(Team::class, 'users_teams', 'team_id', 'user_id');
    }
    
}
