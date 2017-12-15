<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class SummationController extends Controller
{
    
    // Route: '/'
    public function index()
    {   
        
        return view('index');
    }
    
    /*
     * 
     */
    public function makeSummation(Request $request)
    {   
        dd($request->input('entrada'));
        return view('index');
    }
    
}
