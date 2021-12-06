<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DestinationModel;
use App\Models\EnterpriseModel;
use App\Models\RecordsModel;
use App\Models\VisitorsModel;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
     //=============================={ FILTER }================================//
    public function reports_filter(Request $request)
    {
        $value = $request->all();

        if(empty($value)){
            $data = [
                'visitors' => VisitorsModel::all(),
                'id_visitor' => '',
                'enterprises' => EnterpriseModel::all(),
                'enterprise_id' => '',
                'destinations' => DestinationModel::all(),
                'destination_id' => '',
                'reports' => RecordsModel::all(),
            ];

            return view('reports',$data);
        }else{
            $data = [
                'visitors' => VisitorsModel::all(),
                'id_visitor' => $value['visitor_id'],
                'enterprises' => EnterpriseModel::all(),
                'enterprise_id' => $value['enterprise_id'],
                'destinations' => DestinationModel::all(),
                'destination_id' => $value['destination_id'],
                'reports' => RecordsModel::where('visitor_id', 'LIKE', '%'.$value['visitor_id'] .'%')
                                ->where('enterprise_id', 'LIKE', '%'.$value['enterprise_id'].'%')
                                ->where('destination_id', 'LIKE', '%'.$value['destination_id'].'%')
                                ->get(),
            ];

            return view('reports',$data);
        }
    }
    //=============================={   }================================//
    //=============================={   }================================//
    //=============================={   }================================//
    //=============================={   }================================//
    //=============================={   }================================//
}
