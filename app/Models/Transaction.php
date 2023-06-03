<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $with = ['customer'];

    public function getCreatedAtAttribute($date)
    {
        if ($date) {
            return Carbon::createFromFormat('Y-m-d H:i:s', $date)->translatedFormat('d F Y');
        }
    }

    public function getTargetDateCompleteAttribute($date)
    {
        if ($date) {
            return Carbon::createFromFormat('Y-m-d', $date)->translatedFormat('d F Y');
        }
    }

    public function getDateCompleteAttribute($date)
    {
        if ($date) {
            return Carbon::createFromFormat('Y-m-d', $date)->translatedFormat('d F Y');
        }
    }

    // public function getUpdatedAtAttribute($date)
    // {
    //     return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
    // }

    public function cashiers()
    {
        return $this->hasOne(Cashier::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
    // public function price()
    // {
    //     return $this->belongsTo(Price::class);
    // }

    // public function service()
    // {
    //     return $this->belongsTo(Service::class);
    // }

    // public function duration()
    // {
    //     return $this->belongsTo(Duration::class);
    // }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

    // public function product()
    // {
    //     return $this->belongsTo(Product::class);
    // }
    // public function unit()
    // {
    //     return $this->belongsTo(Unit::class);
    // }
    // public function type()
    // {
    //     return $this->belongsTo(Type::class);
    // }
}
