<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SuratJalanController extends Controller
{
    public function index(){
    	return view('suratjalan');
    }
}
