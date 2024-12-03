<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, HasSlug;
    protected $fillable = [
        'title',
        'slug',
        'description',
        'published',
        'inStock',
        'price',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function product_images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    public function scopeFiltered(Builder $query)
    {
        $query->when(request('brands'), function (Builder $q) {
            if (is_array(request('brands'))) {
                $q->whereIn('brand_id', request('brands'));
            }
        })
            ->when(request('categories'), function (Builder $q) {
                if (is_array(request('categories'))) {
                    $q->whereIn('category_id', request('categories'));
                }
            })
            ->when(request('prices'), function (Builder $q) {
                $from = request('prices.from', 0);
                $to = request('prices.to', 100000);
                $q->whereBetween('price', [$from, $to]);
            });
    }
}
