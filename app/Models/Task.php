<?php

namespace App\Models;

use App\Models\Traits\HasUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;


class Task extends Model
{
    use HasFactory;
    use HasUser;

    protected $guarded = ['id'];

    protected $casts =[
        'expired_at' =>'datetime'
    ];

    
}
