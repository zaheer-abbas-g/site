<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MultiImages extends Model
{
    use HasFactory;

    protected $fillable = ['image'];

    const CREATED_AT = 'careated_date';
    const UPDATED_AT = 'updated_date';
}
