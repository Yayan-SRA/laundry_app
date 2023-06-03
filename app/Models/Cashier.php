<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cashier extends Model
{
    use HasFactory;

    protected $guarded = [];

    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
