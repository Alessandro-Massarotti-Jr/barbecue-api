<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Barbecue extends Model
{
    use HasFactory;

    protected $table = 'barbecues';

    protected $fillable = [
        'title',
        'date',
        'value_with_drink',
        'value_without_drink',
        'description',
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_has_barbecues')
            ->withPivot('paid', 'with_drink');
    }
}
