<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'customer_id',
        'payment_type',
        'masked_number',
        'paypal_email',
        'card_image_url',
        'token',
    ];
}
