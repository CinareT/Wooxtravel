<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\Admin\Admin;
use App\Models\City\City;
use App\Models\Country\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class AdminsController extends Controller
{
    public function viewLogin(){
        return view('admins.login');
    }
    public function checkLogin(Request $request){
        $remember_me = $request->has('remember_me') ? true : false;
        
        if (auth()->guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $remember_me)) {
            auth()->user();
            return redirect()->route('admins.dashboard');
        }else{
            return redirect()->back()->with(['error' => 'Email or password is incorrect']);
        }
    }
    

    public function index() {
        $countriesCount = Country::select()->count();
        $citiesCount = City::select()->count();
        $adminsCount = Admin::select()->count();

        return view('admins.index', compact('countriesCount', 'citiesCount', 'adminsCount'));
    }

    public function allAdmins() {
        $allAdmins = Admin::select()->orderBy('id', 'desc')->get();
        return view('admins.alladmins', compact('allAdmins'));
    }

    public function createAdmins() {

        return view('admins.createadmins');
    }

    public function storeAdmins(Request $request) {

        $storeAdmins = Admin::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
        ]);

        if($storeAdmins) {
            return Redirect::route('admins.all.admins')->with(['success', 'Admin created successfully']);
        }
    }


}
