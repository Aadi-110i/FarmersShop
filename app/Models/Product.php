<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Product extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'image_url',
        'category',
        'description',
        'price',
        'stock_quantity',
    ];

    protected $appends = ['average_rating', 'review_count'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function getAverageRatingAttribute()
    {
        return $this->reviews()->avg('rating') ?: 0;
    }

    public function getReviewCountAttribute()
    {
        return $this->reviews()->count();
    }
}
