<?php

namespace App\Http\Controllers;

use App\Models\ProductImages;
use App\Models\Products;
use App\Models\Reviews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

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
            "amount" => "required",
            "price" => "required"
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
        $product->price = $request->input("price");
        $product->save();

        return redirect()->route("products.index")->with("success", "Product is aangemaakt.");
    }

    public function show(Products $products)
    {
        //
    }

    public function edit(Products $product)
    {
        $productImages = ProductImages::where("productId", $product->id)->get();
        return view("admin.edit", compact("product", "productImages"));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            "name" => "required",
            "description" => "required",
            "amount" => "required",
            "price" => "required"
        ]);

        if(!$request->image)
        {
            $product = Products::find($id);
            $product->name = $request->input("name");
            $product->description = $request->input("description");
            $product->amount = $request->input("amount");
            $product->image = $request->input("hiddenImage");
            $product->price = $request->input("price");
            $product->save();

            return redirect()->route("products.index")->with("success", "Product is aangepast.");
        }

        $file = $request->file("image");
        $extension = $request->file("image")->getClientOriginalExtension();
        $filename = time(). ".".$extension;
        $file->move("images/products/", $filename);

        $product = Products::find($id);
        $product->name = $request->input("name");
        $product->description = $request->input("description");
        $product->amount = $request->input("amount");
        $product->image = $filename;
        $product->price = $request->input("price");
        $product->save();

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

    public function singleItem($id)
    {
        $product = Products::where("id", $id)->get();
        $productImages = ProductImages::where("productId", $id)->get();
        $reviews = DB::table("reviews")
            ->where("reviews.productId", $id)
            ->join("users", "users.id", "=", "reviews.userId")
            ->select("reviews.*", "users.name", "users.prefix", "users.lastname")
            ->orderBy("reviews.created_at", "DESC")
            ->get();

        $scoreArray = [];

        $averageScore = 0;

        if(count($reviews) > 0)
        {
            foreach($reviews as $review)
            {
                $scoreArray[] = $review->score;
            }

            $averageScore = array_sum($scoreArray) / count($scoreArray);
        }

        return view("user.single-artikel", compact("product", "reviews", "averageScore", "productImages"));
    }

    public function addToCart($id, Request $request)
    {
        $item = Products::where("id", $id)->first();

        $amount = $request->amount;

        Session::push("itemCart", [
            "amount" => $amount,
            "item" => $item
        ]);


//        Session::flush();

        return redirect()->route("shoppingCartView")->with("success", "Product is toegevoegd aan je winkelwagen.");
    }

    public function singleItemReview(Request $request, $id)
    {
        $review = new Reviews;

        $review->review = $request->review;
        $review->userId = Session::get("user")->id;
        $review->productId = $request->productId;
        $review->score = $request->score;

        $review->save();

        return redirect()->route("singleItem", $id)->with("success", "Review geplaatst.");
    }

    public function multipleImagesSingleItem(Request $request, $id)
    {
        $image = new ProductImages;

        $file = $request->file("singleItemImages");
        $extension = $request->file("singleItemImages")->getClientOriginalExtension();
        $filename = time(). ".".$extension;
        $file->move("images/products/", $filename);

        $image->productId = $id;
        $image->image = $filename;

        $image->save();

        return redirect()->route("products.edit", $id)->with("success", "Afbeelding toegevoegd.");
    }

    public function deleteProductImage(Request $request, $id)
    {
        $image = ProductImages::find($id);

        $image->delete();

        return redirect()->route("products.edit", $request->id)->with("success", "Afbeelding verwijderd");
    }

    public function home()
    {
        $products = ["products" => Products::orderBy("id", "desc")->limit(4)];

        return view("user.welcome", $products);
    }

    public function shoppingCartView()
    {
        $totalPrice = 0;

        foreach(Session::get("itemCart") as $item)
        {
            $itemTotal = $item["item"]->price * $item["amount"];

            $totalPrice += $itemTotal;
        }

        return view("user.shopping-cart", compact("totalPrice"));
    }

    public function removeFromCart(Request $request)
    {
        $items = Session::get("itemCart");

        Session::pull("itemCart");

        foreach($items as $index => $item)
        {
            if($index != $request->index)
            {
                Session::push("itemCart", $item);
            }
        }

        return redirect()->route("shoppingCartView");
    }

    public function payView()
    {
        return view("user.afrekenen");
    }
}
