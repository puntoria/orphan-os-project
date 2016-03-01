<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Orphan;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function orphans()
    {
        return view('admin.index');
    }

    public function dashboard() 
    {
        return view('admin.dashboard');
    }

    public function donors() 
    {
        return view('admin.donors');
    }

    public function profile() 
    {
        $type = 'donor';

        if (!auth()->user()->isDonor()) {
            $type = 'admin';
        }

        return view('auth.profile', compact('type'));
    }
}
