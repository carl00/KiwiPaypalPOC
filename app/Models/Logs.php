<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logs extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable = ['order_id', 'status', 'date', 'meta'];
}
