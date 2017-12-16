<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Summation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class SummationController extends Controller
{
    
    private $summation;
    
    public function __construct() {
        $this->summation = new Summation();
    }

    /*
     *  Method to show the input form
     */
    public function index()
    {   
        return view('index');
    }
    
    /*
     *  Method to process input
     */
    public function makeSummation(Request $request)
    {   
        $summation = new Summation();
        $process_sum = $summation->makeSummation($request->input('entrada'));
        
        $response = array('status' => $process_sum,
                            'output' => $summation->getResponseStr());
        
        return Response::json($response);
        
        
        
    }
    
}
