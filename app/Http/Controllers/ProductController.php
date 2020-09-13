<?php

namespace App\Http\Controllers;

use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        return view('products.index');
    }

    public function new(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:products|max:64',
            'description' => '',
            'tags' => '',
        ]);

        DB::table('products')->insert([
            'name' => $validated['name'],
            'description' => $validated['description']
        ]);

        return redirect('/products')->with('status', 'Product saved');
    }

    public function delete(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|integer|exists:products',
        ]);

        DB::table('products')->where('id', '=', $validated['id'])->delete();

        return redirect('/products')->with('status', 'Product was deleted');
    }
}
