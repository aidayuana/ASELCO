<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
    /**
     * Display the super admin dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // You might want to fetch some data to show on the dashboard
        // $stats = ...; 

        // Return the super admin dashboard view
        return view('dashboard.super_admin');
    }

    // You can add more methods as needed for handling other super admin tasks
}
