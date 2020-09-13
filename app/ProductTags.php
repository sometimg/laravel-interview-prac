<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ProductTags extends Model
{
    protected $fillable = [
        'slug', 'name'
    ];

    /**
     * Determine if a given set of tags exist in the database, create them if not
     * @param $tags
     * @param $product_id int the product id
     * @return array list of ids that were found to match
     */
    public static function add($tags, $product_id = null)
    {
        $tag_ids = [];
        foreach ($tags as $tag) {
            $slug = Str::slug($tag);
            $t = ProductTags::firstOrNew([
                'slug' => $slug
            ], [
                'slug' => $slug,
                'name' => $tag
            ]);

            if (!$t->id) {
                $t->save();
            }
            $tag_ids[] = $t->id;
        }

        if (!empty($product_id)) {
            self::addProductTagRelationships($product_id, $tag_ids);
        }

        return $tag_ids;
    }

    /**
     * Add all of the tags for a given product.
     * @param $product_id
     * @param $tags
     */
    public static function addProductTagRelationships($product_id, $tags)
    {
        $data = [];

        foreach ($tags as $tag) {
            $data[] = [
                'product_id' => $product_id,
                'product_tag_id' => $tag
            ];
        }

        ProductHasTags::insert($data);
    }
}
