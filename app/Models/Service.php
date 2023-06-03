<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Service extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // public function transactions()
    // {
    //     return $this->hasMany(Transaction::class);
    // }

    public function prices()
    {
        return $this->hasMany(Price::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function stores(): BelongsToMany
    {
        return $this->belongsToMany(Store::class, 'store_service', 'service_id', 'store_id');
    }
}
