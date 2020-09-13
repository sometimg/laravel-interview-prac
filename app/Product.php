<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Product extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description'
    ];

    /**
     * The tags that this product has
     * @return HasManyThrough
     */
    public function tags()
    {
        return $this->hasManyThrough(
            'App\ProductTags',
            'App\ProductHasTags',
            'product_id',
            'id'
        );
    }

    public function addTags($product_id, $tags)
    {
        ProductTags::add($tags, $product_id);
    }
}
