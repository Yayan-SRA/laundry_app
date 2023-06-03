<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Type extends Model
{
    use HasFactory;

    protected $guarded = [];

    // public function transactions()
    // {
    //     return $this->hasMany(Transaction::class);
    // }
    public function prices()
    {
        return $this->hasMany(Price::class);
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function durations()
    {
        return $this->hasMany(Duration::class);
    }
    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function stores(): BelongsToMany
    {
        return $this->belongsToMany(Store::class, 'store_type', 'type_id', 'store_id');
    }
}
