<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BreachEvent extends Model
{
   use HasFactory;

   protected $fillable = [
        'identity_id', 'source', 'date', 'severity', 'status', 'endpoint', 'data_types'
   ];

   protected $casts = [
        'data_types' => 'array',
        'date' => 'date',
   ];

   public function identity(){
        return $this->belongsTo(Identity::class);
   }
}
