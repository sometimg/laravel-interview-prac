<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Products</title>

        <style>
            .alert-success {
                color: green;
            }
            .alert-fail {
                color: red
            }
        </style>
    </head>
    <body>

        <h1>Current Products</h1>

        @forelse(\App\Product::all() as $product)
        <ul>
            <li>
                {{ $product->name }}
                <form action="/products/delete" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $product->id }}"/>
                    <button type="submit">delete</button>
                </form>
            </li>
        </ul>
        @empty
            <p><em>No products have been created yet.</em></p>
        @endforelse



        @if (session('status'))
        <div class="alert-success">
            {{ session('status') }}
        </div>
        @endif



        <h2>New product</h2>
        @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
            <li class="alert-fail">{{ $error }}</li>
            @endforeach
        </ul>
        @endif

        <form action="/products/new" method="POST">
            @csrf
            <input type="text" name="name" placeholder="name" /><br />
            <textarea name="description" placeholder="description"></textarea><br />
            <input type="text" name="tags" placeholder="tags" /><br />
            <button type="submit">Submit</button>
        </form>

    </body>
</html>
