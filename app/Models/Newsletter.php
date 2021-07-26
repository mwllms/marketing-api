<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
    use HasFactory;

    protected $fillable = [
        'campaign_id',
        'from_name',
        'from_email',
        'subject',
        'content',
        'html',
        'json',
        'planned',
        'send',
        'status',
    ];
}
