<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ViewController extends Controller
{
//============================[LISTA]==============================//
    function home()
    {
        return view('home');
    }

    function enterprise()
    {

        return view('enterprise');
    }

    public function visitors()
    {
        return view('visitors');

    }

    public function reason()
    {
        return view('reason');
    }

    public function destination()
    {
        return view('destination');
    }

//=========================[RELARÓRIOS]===========================//
    public function reports_enterprise()
    {
        return view('reports_enterprise');
    }

      public function reports_visitors()
    {
        return view('reports_visitors');
    }

      public function reports_date()
    {
        return view('reports_date');
    }
//==============================[]=================================//
//==============================[]=================================//
//==============================[]=================================//
//==============================[]=================================//
//==============================[]=================================//
//==============================[]=================================//
}
