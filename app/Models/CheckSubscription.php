<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckSubscription extends Model
{
    use HasFactory;
    protected $fillable = [
        'domain',
        'email',
        'phone',
    ];
}
