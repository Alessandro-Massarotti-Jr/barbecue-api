<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasAttributes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable, HasAttributes;

    protected $table = "users";

    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_image_path',
        'email_verified_at'
    ];

    protected $hidden = [
        'password',
        'profile_image_path'
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    protected function profileImageUrl(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->profile_image_path ?  asset('storage' . str_replace('public', '', $this->profile_image_path)) : null,
        );
    }

    public function ownerBarbecues(): HasMany
    {
        return $this->hasMany(Barbecue::class, 'owner_id', 'id');
    }

    public function barbecues(): BelongsToMany
    {
        return $this->belongsToMany(Barbecue::class, 'user_has_barbecues')
            ->withPivot('paid', 'with_drink');
    }
}
