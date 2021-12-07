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

            $datefrom = '2000-01-01';
            $dateto = date("Y-m-d H:i:s");


            //  date('d/m/Y  H:m', strtotime($record->date_entrance))
            if($value['datefrom']){
                $datefrom =  date('Y-m-d H:m', strtotime($value['datefrom']));
            }
            if($value['dateto']){
                $dateto = date('Y-m-d H:m', strtotime($value['dateto']));
            }

            $data = [
                'visitors' => VisitorsModel::all(),
                'id_visitor' => $value['visitor_id'],
                'enterprises' => EnterpriseModel::all(),
                'enterprise_id' => $value['enterprise_id'],
                'destinations' => DestinationModel::all(),
                'destination_id' => $value['destination_id'],
                'date_from' => $datefrom,
                'date_to' => $dateto,
                'reports' => RecordsModel::where('visitor_id', 'LIKE', '%'.$value['visitor_id'] .'%')
                                ->where('enterprise_id', 'LIKE', '%'.$value['enterprise_id'].'%')
                                ->where('destination_id', 'LIKE', '%'.$value['destination_id'].'%')
                                ->whereBetween('date_entrance', [$datefrom, $dateto])
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
