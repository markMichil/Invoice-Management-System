<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function __construct(){
        $this->pageTitle = 'Dashboard';
    }

   public function index(){

       return view('AdminPanel.PagesContent.index')->with('pageTitle',$this->pageTitle);
   }




}
