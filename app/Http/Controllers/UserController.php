<?php

namespace App\Http\Controllers;

use App\Models\bestellingenProducten;
use App\Models\invoices;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Mail\factuur;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function loginView()
    {
        return view("user.login");
    }

    public function registerView()
    {
        return view("user.register");
    }

    public function register(Request $request)
    {
        $request->validate([
            "name" => "required",
            "lastname" => "required",
            "email" => "required|email|unique:users",
            "password" => "required",
        ]);

        $user = new User;

        $user->name = $request->name;
        $user->lastname = $request->lastname;
        $user->prefix = $request->prefix;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $user->save();

        return redirect()->route("loginView")->with("success", "Je account is aangemaakt.");
    }

    public function login(Request $request)
    {
        $request->validate([
            "email" => "required",
            "password" => "required"
        ]);

        $user = User::where("email", $request->email)->first();

        if($user)
        {
            if(Hash::check($request->password, $user->password))
            {
                $request->session()->put("user", $user);
                return redirect()->route("home");
            }
            else
            {
                return redirect()->route("loginView")->with("error", "Wachtwoord is onjuist.");
            }
        }
        else
        {
            return redirect()->route("loginView")->with("error", "Email adress niet gevonden.");
        }
    }

    public function logout()
    {
        if(Session::has("user"))
        {
            Session::pull("user");
            return redirect()->route("loginView");
        }
        return abort(404);
    }

    public function orders()
    {
        $orders = DB::table("bestellingen_productens")
        ->where("archived", 0)
        ->join("products", "products.id", "=", "bestellingen_productens.productId")
        ->join("bestellingens", "bestellingens.id", "=", "bestellingen_productens.orderId")
        ->select("bestellingen_productens.amount", "bestellingen_productens.id", "products.name", "bestellingens.firstname", "bestellingens.lastname", "bestellingens.prefix", "bestellingens.phonenumber", "bestellingens.email", "bestellingens.adress", "bestellingens.housenumber", "bestellingens.postalcode", "bestellingens.residence", "bestellingens.created_at")
        ->orderBy("created_at", "DESC")
        ->get();
        return view("admin.orders", compact("orders"));
    }

    public function archive()
    {
        $archivedItems = "";

        return view("admin.archive", compact("archivedItems"));
    }

    public function archiveProduct($id)
    {
        $order = bestellingenProducten::where("id", $id)->first();
        $order->archived = 1;

        $order->save();

        return redirect()->route("admin.orders")->with("success", "Bestelling gearchiveerd");
    }

    public function sendMail()
    {
        Mail::to("yusufyildiz@live.nl")->send(new factuur("1675355205.pdf"));
    }

    public function generatePDF()
    {
        $pdf = PDF::loadView("pdf.pdf_test");
        $pdf->setPaper("A4", "portrait");
        $pdfName = time();
        $pdf->save("invoices/" . $pdfName .".pdf");

        $invoice = new invoices();

        $invoice->fileName = $pdfName . ".pdf";
        $invoice->order_id = 5;

        return $pdf->stream();
//        return $pdf->download("pdf_file.pdf");
    }

    public function test()
    {
        return view("user.test");
    }

    public function testPost(Request $request)
    {
        if($request->password == "socrates123")
            return view("user.welcome");
        else
            return view("user.test");
    }
}
