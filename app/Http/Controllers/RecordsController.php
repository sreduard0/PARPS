<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\RecordsModel;
use App\Models\VisitorsModel;
use Illuminate\Http\Request;
use App\Classes\Tools;
class RecordsController extends Controller
{
    private $Tools;
    public function __construct()
    {
        $this->Tools = new Tools();
    }
    //===========================[View]============================
       function records()
    {
        $data = [
            'records' => RecordsModel::all(),
            'visitors' => VisitorsModel::all(),
        ];
        return view('home',$data);
    }
}
