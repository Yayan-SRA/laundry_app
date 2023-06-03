<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
    public function expenditures()
    {
        return $this->hasMany(Expenditure::class);
    }
    public function durations()
    {
        return $this->hasMany(Duration::class);
    }
}
