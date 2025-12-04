<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }
    public function superDashboard()
    {
        return view('super.dashboard');
    }

    public function superProducts()
    {
        return view('super.product');
    }

    public function superSold()
    {
        return view('super.sold');
    }

    public function superUsers()
    {
        return view('super.users');
    }

    
      public function superLogout(){
        return redirect('/');
    }

    public function superProfile(){
        return view('super.profile');
    }


    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function products()
    {
        return view('admin.product');
    }

    public function sold()
    {
        return view('admin.sold');
    }

    public function users()
    {
        return view('admin.users');
    }
    
    public function profile(){
        return view('admin.profile');
    }

    
      public function logout(){
        return redirect('/');
    }




      public function userLogout(){
        return redirect('/');
    }

    public function userDashboard()
    {
        return view('user.dashboard');
    }

    public function userProducts()
    {
        return view('user.product');
    }

    public function userSold(){
        return view('user.sold');
    }

      public function userProfile(){
        return view('user.profile');
    }

    public function login()
    {
        return view('login');
    }

  

  

  

}
