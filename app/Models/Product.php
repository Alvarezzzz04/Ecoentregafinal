<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id_product';
    public $timestamps = false;

    protected $fillable = [
        'product_name',
        'description',
        'price',
        'size',
        'garment_condition',
        'color',
        'image',
        'publication_date',
        'id_category',
        'id_user',
        'stock'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'id_category');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function cartDetails()
    {
        return $this->hasMany(CartDetail::class, 'id_product');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'id_product');
    }

    public function requestDetails()
    {
        return $this->hasMany(RequestDetail::class, 'id_product');
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'id_product');
    }

    public function getImageUrlAttribute()
    {
        if (empty($this->image)) {
            return null;
        }
        if (str_starts_with($this->image, 'http')) {
            return $this->image;
        }
        return asset('storage/' . ltrim($this->image, '/'));
    }
}
