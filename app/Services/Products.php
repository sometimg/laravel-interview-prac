<?php
namespace App\Services;
use App\Product;

class Products implements ProductContract
{
    /**
     * Get all the products
     * @return mixed
     */
    public function get() {
        return Product::all();
    }

    /**
     * Create a new product
     * @param $with
     * ['name'] the name of the product
     * ['description'] the description of the product
     * @return id the id of the product created
     */
    public function create($with) {
        $model = Product::create([
            'name' => $with['name'],
            'description' => $with['description']
        ]);

        return $model->id;
    }

    /**
     * Delete a product with a given ID
     * @param $id
     */
    public function delete($id) {
        Product::where('id', '=', $id)->delete();
    }
}
