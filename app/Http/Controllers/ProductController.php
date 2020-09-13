<?php

namespace App\Http\Controllers;

use App\Product;
use App\Services\ProductContract;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /** @var ProductContract $products */
    private $products;

    public function __construct(ProductContract $products)
    {
        $this->products = $products;
    }

    public function index()
    {
        return view('products.index', [
            'products' => $this->products->get()
        ]);
    }

    public function new(Request $request)
    {
        $validated = $this->validateName($request);
        $id = $this->products->create($validated);

        return redirect('/products')
            ->with('status', 'Product saved')
            ->with('id', $id);
    }

    public function delete(Request $request)
    {
        $validated = $this->validateId($request);
        $this->products->delete($validated['id']);

        return redirect('/products')->with('status', 'Product was deleted');
    }

    private function validateName(Request &$request)
    {
        return $request->validate([
            'name' => 'required|unique:products|max:64',
            'description' => '',
            'tags' => '',
        ]);
    }

    private function validateId(Request &$request)
    {
        return $request->validate([
            'id' => 'required|integer|exists:products',
        ]);
    }
}
