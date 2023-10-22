<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class UserHasBarbecue extends Model
{
    use HasFactory;

    protected $table = "user_has_barbecues";

    protected $fillable = [
        'user_id',
        'barbecue_id',
        'paid',
        'with_drink',
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'user_id', 'id');
    }

    public function barbecue(): HasOne
    {
        return $this->hasOne(Barbecue::class, 'barbecue_id', 'id');
    }
}
