<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Ramsey\Uuid\Type\Integer;

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
    public function partners()
    {
        return $this->belongsToMany(User::class, 'partner_user', 'user_id', 'partner_id');
    }

    // Add a new partner
    public function addPartner(User $user)
    {
        $this->partners()->attach($user->id);
    }

    // Remove a partner
    public function removePartner(User $user)
    {
        $this->partners()->detach($user->id);
    }

    // Replaces existing partner with new one
    public function replacePartner(User $user)
    {
        $this->partners()->sync($user->id);
    }

    // this function allows you do $user->roles which will return all the roles for that user
    public function roles()
    {
        return $this->belongsToMany('App\Models\Role', 'user_role');
    }

    // Many to many relationship, including the pivot table for a users' interests
    public function interests()
    {
        return $this->belongsToMany(Interest::class, 'interest_users');
        // return $this->belongsToMany(Integer::class, 'interest_users', 'user_id', 'interest_id');
    }

    // 1:M relationship between Countries and Users (countries or countrys?)
    public function country()
    {
        return $this->belongsTo(Country::class);
    }


    // Checks if user is Admin, no errors (used in nav to display items only to Users)
    public function isAdministrator()
    {
        return $this->hasRole('Admin');
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
        'country_id',
        'language',
        'level',
        'user_image'
    ];

    protected $table = 'users';

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
