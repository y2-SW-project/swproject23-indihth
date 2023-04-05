<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // Defining the 1-M relationship between users and goals
    public function goals()
    {
        return $this->hasMany(Goal::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    // Many to many relationship created for future feature to be developed
    public function partnerships()
    {
        return $this->hasMany(Partnership::class);
    }

    // this function allows you do $user->roles which will return all the roles for that user
    public function roles()
    {
        return $this->belongsToMany('App\Models\Role', 'user_role');
    }

    public function interests() 
    {
        return $this->belongsToMany('App\Models\Interest', 'interest_users');
    }

    public function interestUser() 
    {
        return $this->hasMany('App\Models\InterestUser', 'interest_users');
    }



    // Function to check if a user is authorised to do a certain task
    // Returns error otherwise
    public function authorizeRoles($roles)
    {
        if (is_array($roles)) {
            return $this->hasAnyRole($roles) ||
                abort(401, 'This action is unauthorzed');
        }
        return $this->hasRole($roles) ||
            abort(401, 'This action is unauthorized');
    }

    // Assignes roles to users
    public function hasRole($role)
    {
        return null !== $this->roles()->where('name', $role)->first();
    }

    public function hasAnyRole($roles)
    {
        return null !== $this->roles()->whereIn('name', $roles)->first();
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'about_me',
        'level',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
