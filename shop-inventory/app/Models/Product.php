<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['user_id', 'category_id', 'img_url', 'name', 'type', 'description', 'price', 'unit', 'is_active'];
}
