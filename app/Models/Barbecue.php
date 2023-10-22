<?php

namespace App\Models;

use App\Helpers\Logger;
use Illuminate\Database\Eloquent\Casts\Attribute;
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
        'owner_id'
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }

    protected function totalValue(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                $totalWithDrinkQuantity = 0;
                $totalWithoutDrinkQuantity = 0;
                foreach ($this->users as $user) {
                    if ($user->pivot->with_drink) {
                        $totalWithDrinkQuantity += 1;
                    } else {
                        $totalWithoutDrinkQuantity += 1;
                    }
                }
                return ($this->value_with_drink * $totalWithDrinkQuantity) + ($this->value_without_drink * $totalWithoutDrinkQuantity);
            }
        );
    }

    protected function totalPaidValue(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                $totalpaidWithDrinkQuantity = 0;
                $totalpaidWithoutDrinkQuantity = 0;
                foreach ($this->users as $user) {
                    if ($user->pivot->paid) {
                        if ($user->pivot->with_drink) {
                            $totalpaidWithDrinkQuantity += 1;
                        } else {
                            $totalpaidWithoutDrinkQuantity += 1;
                        }
                    };
                }
                return ($this->value_with_drink * $totalpaidWithDrinkQuantity) + ($this->value_without_drink * $totalpaidWithoutDrinkQuantity);
            }
        );
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_has_barbecues')
            ->withPivot('paid', 'with_drink');
    }
}
