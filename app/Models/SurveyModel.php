<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class SurveyModel extends Model
{
    use HasFactory, Notifiable;
    
    protected $table = 'survey';
    protected $fillable = [
        'customer_id',
        'q1',
        'q2',
        'q3',
        'q4',
        'q5',
        'q6',
        'q7',
        'q8',
        'q9',
        'q0',
        'sentiment'
        // 'created_at'
    ];
}
