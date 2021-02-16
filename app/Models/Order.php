<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable = ['payer_email', 'payer_json', 'client_email', 'client_json', 'meta', 'amount', 'minutes', 'status'];
}
