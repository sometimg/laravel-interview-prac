<?php
namespace App\Services;

use App\Events\ProductCreated;
use App\Product;

class Products implements ProductContract
{
    /**
     * Get all the products
     * @return mixed
     */
    public function get()
    {
        return Product::all();
    }

    /**
     * Create a new product
     * @param $with
     * ['name'] the name of the product
     * ['description'] the description of the product
     * ['tags'] the given tags
     * @return id the id of the product created
     */
    public function create($with)
    {
        $model = Product::create([
            'name' => $with['name'],
            'description' => $with['description']
        ]);

        if (!empty($with['tags'])) {
            $model->addTags($model->id, $this->unique_tags($with['tags']));
        }

        event(new ProductCreated($model));

        return $model->id;
    }

    /**
     * Delete a product with a given ID
     * @param $id
     */
    public function delete($id)
    {
        Product::where('id', '=', $id)->delete();
    }

    /**
     * Get all of the unique tags
     * @param $string list of all the tags, separated by commas.
     * @return array of strings that are tags
     */
    private function unique_tags($string)
    {
        $output = explode(",", $string);
        $clean = array_map('trim', $output);
        return array_unique($clean);
    }
}
