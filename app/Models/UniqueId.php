<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UniqueId extends Model
{
    use HasFactory;

    protected $table = 'unique_ids';

    protected $fillable = [
        'value',
    ];
}
