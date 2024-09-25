<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class  Log extends Model
{
    use HasFactory;

    protected $fillable = ['action', 'invoice_id', 'user_id', 'user_role'];

    // Relationship with Invoice
    public function invoice()
    {
        return $this->belongsTo(Invoice::class,'invoice_id','id');
    }

    // Relationship with User
    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
