<?php

namespace App\Http\Controllers;


class HomeController extends Controller
{
    public function superDashboard()
    {
        $pageTitle = 'Super Admin Dashboard';
        return view('super.dashboard', compact('pageTitle'));
    }

    public function superProducts()
    {
        $pageTitle = 'Super Admin Products';
        return view('super.product', compact('pageTitle'));
    }

    public function superSold()
    {
        $pageTitle = 'Super Admin Sales Products';
        return view('super.sold', compact('pageTitle'));
    }

    public function superUsers()
    {
        $pageTitle = 'Super Admin Users';
        return view('super.users', compact('pageTitle'));
    }

    public function superHistory()
    {
        $pageTitle = 'Super Admin History';
        return view('super.history', compact('pageTitle'));
    }


      public function superLogout(){
        return redirect('/');
    }

    public function superProfile(){

        $pageTitle = 'Super Admin Profile';
        return view('super.profile', compact('pageTitle'));
    }


    public function dashboard()
    {
        $pageTitle = 'Admin Dashboard';
        return view('admin.dashboard', compact('pageTitle'));
    }

    public function products()
    {
        $pageTitle = 'Admin Products';
        return view('admin.product', compact('pageTitle'));
    }

    public function sold()
    {
        $pageTitle = 'Admin Sales Products';
        return view('admin.sold', compact('pageTitle'));
    }

    public function users()
    {
        $pageTitle = 'Admin Users';
        return view('admin.users', compact('pageTitle'));
    }

    public function profile(){

        $pageTitle = 'Admin Profile';
        return view('admin.profile', compact('pageTitle'));
    }

    public function history(){

        $pageTitle = 'Admin History';
        return view('admin.history', compact('pageTitle'));
    }


      public function logout(){
        return redirect('/');
    }




      public function userLogout(){
        return redirect('/');
    }

    public function userDashboard()
    {

        $pageTitle = 'User Dashboard';
        return view('user.dashboard', compact('pageTitle'));
    }

    public function userProducts()
    {
        $pageTitle = 'User Products';
        return view('user.product', compact('pageTitle'));
    }

    public function userSold(){

        $pageTitle = 'User Sales Products';
        return view('user.sold', compact('pageTitle'));
    }

      public function userProfile(){

        $pageTitle = 'User Profile';
        return view('user.profile', compact('pageTitle'));
    }

    public function login()
    {
        return view('login');
    }

}
