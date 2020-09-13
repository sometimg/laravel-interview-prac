<?php
namespace App\Services;
use App\Product;

class Products implements ProductContract
{
    /**
     * Create a new product
     * @param $with
     * ['name'] the name of the product
     * ['description'] the description of the product
     * @return id the id of the product created
     */
    public function create($with) {
        return Product::insertGetId([
            'name' => $with['name'],
            'description' => $with['description']
        ]);
    }

    public function delete($id) {
        Product::where('id', '=', $id)->delete();
    }
}
