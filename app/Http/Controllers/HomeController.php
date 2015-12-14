<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function dashboard()
    {
        if ( auth()->user()->isDonor() ) return redirect()->to( route('Donor::dashboard') );

        return redirect()->to( route('Admin::dashboard') );
    }
}
