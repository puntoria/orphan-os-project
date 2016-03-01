<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class DonorController extends Controller
{
    public function dashboard() 
    {
        return view('donor.dashboard');
    }

    public function orphans() 
    {
        return view('donor.index');
    }
}
