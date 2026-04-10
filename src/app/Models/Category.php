<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'content',
    ];

    public $timestamps = false;

    public function items()
{
    return $this->belongsToMany(Item::class, 'item_category')->withTimestamps();
}
}