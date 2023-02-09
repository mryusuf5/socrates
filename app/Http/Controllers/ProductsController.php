<?php

namespace App\Http\Controllers;

use App\Mail\factuur;
use App\Mail\order;
use App\Models\bestellingen;
use App\Models\bestellingenProducten;
use App\Models\invoices;
use App\Models\ProductImages;
use App\Models\Products;
use App\Models\Reviews;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
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

        return redirect()->route("admin.products.index")->with("success", "Product is aangemaakt.");
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

            return redirect()->route("admin.products.index")->with("success", "Product is aangepast.");
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

        return redirect()->route("admin.products.index")->with("success", "Product is aangepast.");
    }

    public function destroy(Products $product)
    {
        $product->delete();

        return redirect()->route("admin.products.index")->with("success", "Product is verwijderd.");
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

        return redirect()->route("admin.products.edit", $id)->with("success", "Afbeelding toegevoegd.");
    }

    public function deleteProductImage(Request $request, $id)
    {
        $image = ProductImages::find($id);

        $image->delete();

        return redirect()->route("admin.products.edit", $request->id)->with("success", "Afbeelding verwijderd");
    }

    public function home()
    {
        $products = ["products" => Products::orderBy("id", "desc")->limit(4)];

        return view("user.welcome", $products);
    }

    public function shoppingCartView()
    {
        $totalPrice = 0;
        if(Session::get("itemCart"))
        {
            foreach(Session::get("itemCart") as $item)
            {
                $itemTotal = $item["item"]->price * $item["amount"];

                $totalPrice += $itemTotal;
            }
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
        $itemsPrices = 0;
        Session::pull("totalPrice");
        foreach(Session::get("itemCart") as $cart)
        {
            $itemsPrices += $cart["item"]["price"];
        }
        $itemsPrices += 4.15;
        Session::push("totalPrice", number_format($itemsPrices, 2));
        return view("user.afrekenen-details");
    }

    public function payCredentialsView()
    {
        return view("user.afrekenen-details");
    }

    public function checkout(Request $request)
    {
        $request->validate([
            "firstname" => "required",
            "lastname" => "required",
            "email" => "required|same:confirmEmail",
            "confirmEmail" => "required",
            "phone" => "required",
            "adress" => "required",
            "housenumber" => "required",
            "postalcode" => "required",
            "residence" => "required",
            "over18" => "required"
        ]);

        Session::pull("payementInfo");
        Session::push("payementInfo", $request->all());

        \Stripe\Stripe::setApiKey(config("stripe.sk"));

        $price = number_format(Session::get("totalPrice")[0], 2, ".");

        $session = \Stripe\Checkout\Session::create([
            "line_items" => [
                [
                    "price_data" => [
                        "currency" => "eur",
                        "product_data" => [
                            "name" => "Bestelling Socrates microdosing"
                        ],
                        "unit_amount" => str_replace(".", "", $price)
                    ],
                    "quantity" => 1
                ]
            ],
            "mode" => "payment",
            "success_url" => route("success"),
            "cancel_url" => route("home")
        ]);

        return redirect()->away($session->url);
    }

    public function success()
    {
        $pdfName = time();
        $totalPrice = 0;

        $bestelling = new bestellingen();
        $bestelling->firstname = Session::get("payementInfo")[0]["firstname"];
        $bestelling->prefix = Session::get("payementInfo")[0]["prefix"];
        $bestelling->lastname = Session::get("payementInfo")[0]["lastname"];
        $bestelling->email = Session::get("payementInfo")[0]["email"];
        $bestelling->phonenumber = Session::get("payementInfo")[0]["phone"];
        $bestelling->adress = Session::get("payementInfo")[0]["adress"];
        $bestelling->housenumber = Session::get("payementInfo")[0]["housenumber"];
        $bestelling->postalcode = Session::get("payementInfo")[0]["postalcode"];
        $bestelling->residence = Session::get("payementInfo")[0]["residence"];

        $bestelling->save();

        $order = bestellingen::orderBy("id", "DESC")->where("adress", Session::get("payementInfo")[0]["adress"])->firstOrFail();

        foreach(Session::get("itemCart") as $cart)
        {
            $bestellingOrder = new bestellingenProducten();
            $bestellingOrder->orderId = $order->id;
            $bestellingOrder->productId = $cart["item"]["id"];
            $bestellingOrder->amount = $cart["amount"];
            $bestellingOrder->save();
        }

        $orders = DB::table("bestellingen_productens")
            ->join("products", "bestellingen_productens.productId" , "=" , "products.id")
            ->select("bestellingen_productens.*", "products.name", "products.description", "products.price")
            ->where("bestellingen_productens.orderId", $order->id)
            ->get();

        foreach($orders as $order)
        {
            $currentPrice = $order->amount * $order->price;
            $totalPrice += $currentPrice;
        }

        $data = [
            "products" => $orders,
            "totalPrice" => $totalPrice,
            "user" => Session::get("payementInfo")[0],
            "invoiceCode" => $pdfName
        ];

        $pdf = PDF::loadView("pdf.pdf_view", $data);
        $pdf->setPaper("A4", "portrait");

        $pdf->save("invoices/" . $pdfName .".pdf");

        $invoice = new invoices();

        $invoice->fileName = $pdfName . ".pdf";
        $invoice->order_id = $order->id;

        $invoice->save();

        Mail::to(Session::get("payementInfo")[0]["email"])->send(new factuur($pdfName));
        Mail::to("so-cratesmd@hotmail.com")->send(new order($data));

        Session::pull("itemCart");

        return view("user.succes");
    }
}
