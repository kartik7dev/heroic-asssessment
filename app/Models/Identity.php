<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Identity extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email'];

    public function breachEvents()
    {
        return $this->hasMany(BreachEvent::class);
    }
}
