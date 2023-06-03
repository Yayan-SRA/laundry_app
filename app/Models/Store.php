<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Store extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function customers()
    {
        return $this->hasMany(Customer::class);
    }

    public function cashiers()
    {
        return $this->hasMany(Cashier::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function finances()
    {
        return $this->hasMany(Finance::class);
    }
    public function expenditures()
    {
        return $this->hasMany(Expenditure::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'store_product', 'store_id', 'product_id');
    }
    public function types(): BelongsToMany
    {
        return $this->belongsToMany(Type::class, 'store_type', 'store_id', 'type_id');
    }
    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class, 'store_service', 'store_id', 'service_id');
    }
    public function durations(): BelongsToMany
    {
        return $this->belongsToMany(Duration::class, 'store_duration', 'store_id', 'duration_id');
    }
}
