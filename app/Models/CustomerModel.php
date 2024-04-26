<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class CustomerModel extends Model
{
    use HasFactory, Notifiable;
    
    protected $table = "tickets";
    protected $fillable = [
        'customer_id',
        'name',
        'department',
        'subject',
        'email',
        'description',
        'image',
        'prio',
        'handler',
        'status',
        'remarks',
        // 'created_at'
    ];
}
