<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id',
        'customer_id',
        'user_id',
        'amount',
        'invoice_date',
        'description',
        'status',
        'serial_number',
        'delivery_status'
    ];

    // Delivery status enum options
    const STATUS_PENDING = 'PENDING';
    const STATUS_CONFIRMED = 'CONFIRMED';
    const STATUS_ON_THE_WAY = 'ON_THE_WAY';
    const STATUS_DELIVERED = 'DELIVERED';


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($invoice) {
            // Generate a unique serial number
            $invoice->serial_number = 'INV-' . uniqid(); // You can customize the format
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }


}
