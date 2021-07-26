<?php

namespace App\Models;

use App\Traits\Uuids;
use App\Models\Newsletter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Campaign extends Model
{
    use HasFactory, Uuids;

    protected $fillable = [
        'name',
        'company_id',
        'channels',
    ];
}
