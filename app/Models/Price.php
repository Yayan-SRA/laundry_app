<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // public function transactions()
    // {
    //     return $this->hasMany(Transaction::class);
    // }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function duration()
    {
        return $this->belongsTo(Duration::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
    public function type()
    {
        return $this->belongsTo(Type::class);
    }
}
