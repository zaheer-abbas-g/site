<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = ['short_description', 'service_icon', 'service_title', 'service_description', 'feature_description', 'featur_icon', 'feature_title'];
}
