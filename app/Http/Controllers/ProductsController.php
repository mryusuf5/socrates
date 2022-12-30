<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Products::latest()->paginate(10);

        return view("admin.index", compact("products"));
    }

    public function create()
    {
        return view("admin.create");
    }

    public function store(Request $request)
    {
        $request->validate([
            "name" => "required",
            "description" => "required",
            "image" => "required",
            "amount" => "required"
        ]);

        $file = $request->file("image");
        $extension = $request->file("image")->getClientOriginalExtension();
        $filename = time(). ".".$extension;
        $file->move("images/products/", $filename);

        $product = new Products();
        $product->name = $request->input("name");
        $product->description = $request->input("description");
        $product->amount = $request->input("amount");
        $product->image = $filename;
        $product->save();

        return redirect()->route("products.index")->with("success", "Product is aangemaakt.");
    }

    public function show(Products $products)
    {
        //
    }

    public function edit(Products $product)
    {
        return view("admin.edit", compact("product"));
    }

    public function update(Request $request, Products $product)
    {
        $request->validate([
            "name" => "required",
            "description" => "required",
            "image" => "required",
            "amount" => "required"
        ]);

        $product->update($request->all());

        return redirect()->route("products.index")->with("success", "Product is aangepast.");
    }

    public function destroy(Products $product)
    {
        $product->delete();

        return redirect()->route("products.index")->with("success", "Product is verwijderd.");
    }

    public function allItems()
    {
        $products = Products::latest()->paginate(18);

        return view("user.artikelen", compact("products"));
    }

    public function home()
    {
        $products = ["products" => Products::orderBy("id", "desc")->limit(4)];

        return view("user.welcome", $products);
    }
}
