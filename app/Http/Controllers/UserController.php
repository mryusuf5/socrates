<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

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
}
