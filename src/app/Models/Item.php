<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Condition;
use App\Models\Like;

class Item extends Model
{
    protected $fillable = [
        'user_id',
        'condition_id',
        'name',
        'brand_name',
        'description',
        'price',
        'image',
        'is_sold',
    ];

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function purchase()
    {
        return $this->hasOne(Purchase::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'item_category');
    }

    public function condition()
    {
        return $this->belongsTo(Condition::class);
    }
}