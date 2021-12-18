<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable,Prunable, HasRoles, LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'mobile_number',

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


    //only the `deleted` event will get logged automatically
    protected static $recordEvents = ['deleted','created','updated',];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->useLogName('user')
        ->logOnly(['name', 'email','username','status'])
        ->logOnlyDirty()
        ->dontSubmitEmptyLogs()
        ->setDescriptionForEvent(fn(string $eventName) => "This User has been {$eventName}");
        // ->dontLogIfAttributesChangedOnly(['email'])
        ;
        // Chain fluent methods for configuration options
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function setUsernameAttribute($value)
    {
        $this->attributes['username'] = strtolower($value);
    }
    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = strtolower($value);
    }
    public function getUsernameAttribute($value)
    {
        return  ucfirst($value);
    }

    public function prunable()
    {
        return static::where('id',23);
    }

    public function pruning()
    {
        echo 'Pruning '. $this->username . PHP_EOL;
    }

    public function children()
    {
        return $this->hasMany(User::class,'parent_id')->with('children:id,parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(User::class,'parent_id');
    }

    public function setPasswordAttribute($value)
    {
        if (Hash::needsRehash($value))
        {
            $value = Hash::make($value);
        }

        $this->attributes['password']=$value;
    }

    // public function role()
    // {
    //     return $this->belongsToMany(Role::class, 'role_user');
    // }

}
