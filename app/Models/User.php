<?php

namespace App\Models;

use App\Enums\BookingStatus;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use jeremykenedy\LaravelRoles\Traits\HasRoleAndPermission;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, HasRoleAndPermission, Notifiable, SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
    ];

    /**
     * The attributes that are hidden.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'activated',
        'token',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'first_name',
        'last_name',
        'image',
        'email',
        'password',
        'activated',
        'token',
        'signup_ip_address',
        'signup_confirmation_ip_address',
        'signup_sm_ip_address',
        'admin_ip_address',
        'updated_ip_address',
        'deleted_ip_address',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'first_name' => 'string',
        'last_name' => 'string',
        'email' => 'string',
        'password' => 'string',
        'activated' => 'boolean',
        'token' => 'string',
        'signup_ip_address' => 'string',
        'signup_confirmation_ip_address' => 'string',
        'signup_sm_ip_address' => 'string',
        'admin_ip_address' => 'string',
        'updated_ip_address' => 'string',
        'deleted_ip_address' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    //  protected static function booted()
    // {
    //     // parent::boot();

    //     static::addGlobalScope('notAdmin', function ($query) {
    //         return $query->whereRoleNot('admin');
    //     });
    // }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    /**
     * Get the socials for the user.
     */
    public function social()
    {
        return $this->hasMany(\App\Models\Social::class);
    }

    /**
     * Get the profile associated with the user.
     */
    public function profile()
    {
        return $this->hasOne(\App\Models\Profile::class);
    }

    /**
     * The profiles that belong to the user.
     */
    public function profiles()
    {
        return $this->belongsToMany(\App\Models\Profile::class)->withTimestamps();
    }

    /**
     * Check if a user has a profile.
     *
     * @param  string  $name
     * @return bool
     */
    public function hasProfile($name)
    {
        foreach ($this->profiles as $profile) {
            if ($profile->name === $name) {
                return true;
            }
        }

        return false;
    }

    /**
     * Add/Attach a profile to a user.
     */
    public function assignProfile(Profile $profile)
    {
        return $this->profiles()->attach($profile);
    }

    /**
     * Remove/Detach a profile to a user.
     */
    public function removeProfile(Profile $profile)
    {
        return $this->profiles()->detach($profile);
    }

    /**
     * * ****************************************************************  Relations
     */
    public function tours()
    {
        return $this->hasMany(Tour::class, 'guide_id');
    }

    /**
     * Scope a query to only include users with the given role.
     */
    public function bookings(): hasManyThrough|HasMany
    {
        if (auth()->user()->hasRole('guide|admin')) {
            return $this->hasManyThrough(
                Booking::class,  // المودل النهائي
                Tour::class,     // المودل الوسيط
                'guide_id',      // المفتاح الأجنبي في جدول tours الذي يشير إلى users
                'tour_id',       // المفتاح الأجنبي في جدول bookings الذي يشير إلى tours
                'id',            // المفتاح الأساسي في users
                'id'             // المفتاح الأساسي في tours
            );
        } else {
            return $this->hasMany(Booking::class);
        }
    }

    public function toursBooked()
    {
        return $this->belongsToMany(Tour::class, 'bookings')
            ->withPivot('status')
            ->withTimestamps();
    }

    public function chatRooms()
    {
        return $this->belongsToMany(ChatRoom::class, 'chat_room_user')
            ->withPivot('last_read_at')
            ->withTimestamps();
    }

    /**
     * * ****************************************************************  Scopes
     */
    /**
     * Scope a query to only include myChatRooms
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function scopeMyChatRooms($query)
    {
        if (auth()->user()->isUser()) {
            return $this->chatRooms();
        }

        return \App\Models\ChatRoom::whereHas('tour', function ($q) {
            $q->where('guide_id', auth()->id());
        })->with(['tour']);
    }

    public function scopeWhereRoleIs($query, $role)
    {
        return $query->whereHas('roles', function ($q) use ($role) {
            $q->where('name', $role);
        });
    }

    public function scopeGuides($query)
    {
        return $query->whereHas('roles', function ($q) {
            $q->where('name', 'guide');
        });
    }

    public function scopeWithoutAdmin($query)
    {
        return $query->whereHas('roles', function ($q) {
            $q->where('name', '!=', 'admin');
        });
    }

    public function scopeUsers($query)
    {
        return $query->whereHas('roles', function ($q) {
            $q->where('name', 'user');
        });
    }

    public function scopeWhereRoleNot($query, $role)
    {
        return $query->whereHas('roles', function ($q) use ($role) {
            $q->where('name', '!=', $role);
        });
    }

    /**
     ** *************************************************************************** Normal functions  */
    public function canChat($tour)
    {
        if ($this->id == $tour->guide_id) {
            return true;
        }

        return $this->chatRooms()->where('tour_id', $tour->id)->exists();
        // return $this->bookings()
        //     ->where('tour_id', $tour->id)
        //     ->where('status', BookingStatus::APPROVED->value)
        //     ->exists();
    }

    public function hasApprovedBookingForTour($tourId)
    {
        return $this->bookings()
            ->where('tour_id', $tourId)
            ->where('status', BookingStatus::APPROVED->value)
            ->exists();
    }

    public function hasPendingBookingForTour($tourId)
    {
        return $this->bookings()
            ->where('tour_id', $tourId)
            ->where('status', BookingStatus::PENDING->value)
            ->exists();
    }
}
