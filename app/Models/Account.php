<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        'shareCapital',
        'thriftSavings',
        'specialDeposit',
        'commodityTrading',
        'fine',
        'loan',
        'projectFinancing',
        'userId',

    ];


    function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'userId', 'id');
    }
}
