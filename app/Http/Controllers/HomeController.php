<?php

namespace App\Http\Controllers;

use App\Neodynamic\WebClientPrint;
use Illuminate\Support\Facades\Session;


class HomeController extends Controller
{
    public function index(){

        $wcppScript = WebClientPrint::createWcppDetectionScript(action('WebClientPrintController@processRequest'), Session::getId());

        return view('home.index', ['wcppScript' => $wcppScript]);
    }

    public function printersinfo(){

        $wcpScript = WebClientPrint::createScript(action('WebClientPrintController@processRequest'), action('HomeController@printersinfo'), Session::getId());    

        return view('home.printersinfo', ['wcpScript' => $wcpScript]);

    }

    public function samples(){
        return view('home.samples');
    }
    
}
