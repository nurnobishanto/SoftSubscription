<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
class Invoice extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'invid',
        'user_id',
        'product_id',
        'amount',
        'method',
        'status',
    ];

    protected static function booted()
    {
        static::creating(function ($invoice) {
            do {
                $uniqueId = 'INV' . strtoupper(Str::random(5));
            } while (static::where('invid', $uniqueId)->exists());

            $invoice->invid = $uniqueId;
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
