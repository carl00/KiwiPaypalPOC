<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;
    protected $table = 'subscriptions';
    protected $fillable = ['id', 'start_time', 'meta', 'quantity', 'subscriber', 'status','summary','payment_summary','create_time'];
}
