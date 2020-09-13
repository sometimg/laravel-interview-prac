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
            .pill {
                background-color: lightblue;
                border-radius: 5px;
                display: inline;
                padding: 5px
            }
        </style>
    </head>
    <body>

        <h1>Current Products</h1>

        @if (empty($products))
        <p><em>No products have been created yet.</em></p>
        @else
        <table width="50%">
            <tr>
                <th>Product Name</th>
                <th>Description</th>
                <th>Tags</th>
                <th>Delete</th>
            </tr>
        @foreach($products as $product)
            <tr>
                <td width="50%">{{ $product->name }}</td>
                <td>{{ $product->description }}</td>
                <td>
                    @foreach($product->tags as $tag)
                    <div class="pill">{{ $tag->name }}</div>
                    @endforeach
                </td>
                <td>
                <form action="/products/delete" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $product->id }}"/>
                    <button type="submit">delete</button>
                </form>
                </td>
            </tr>
        @endforeach
        </table>
        @endif



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
