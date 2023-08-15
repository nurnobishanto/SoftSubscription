<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'pid',
        'user_id',
        'name',
        'description',
        'domain',
        'email',
        'phone',
        'url',
        'image',
        'billing',
        'price',
        'start_date',
        'end_date',
    ];
    protected static function booted()
    {
        static::creating(function ($product) {
            do {
                $uniqueId = 'P' . strtoupper(Str::random(5));
            } while (static::where('pid', $uniqueId)->exists());

            $product->pid = $uniqueId;
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'product_id');
    }
}
