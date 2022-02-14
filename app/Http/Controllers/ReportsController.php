<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DestinationModel;
use App\Models\EnterpriseModel;
use App\Models\RecordsModel;
use App\Models\VisitorsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ReportsController extends Controller
{
     //=============================={ FILTER }================================//
    public function reports_filter()
    {
        // if(empty($value)){
            $data = [
                'visitors' => VisitorsModel::all(),
                'id_visitor' => '',
                'enterprises' => EnterpriseModel::all(),
                'enterprise_id' => '',
                'destinations' => DestinationModel::all(),
                'destination_id' => '',
            ];

        return view('reports',$data);
    }


    //================================={ DataTables }====================================//
    public function get_reports(Request $request)
    {

        //Receber a requisão da pesquisa
        $requestData = $request->all();


        //Indice da coluna na tabela visualizar resultado => nome da coluna no banco de dados
        $columns = array(
            0=> 'id',
            1 =>'visitor_id',
            2 => 'destination_id',
            3=> 'reason',
            4=> 'registred_by',
            5=> 'finished_by',
            6=> 'date_entrance',
            7=> 'date_exit',
            8=> 'badge',
        );


        $datefrom = '2000-01-01';
        $dateto = date("Y-m-d H:i");


        if($requestData['columns'][6]['search']['value']){
            $datefrom =  date('Y-m-d H:i', strtotime($requestData['columns'][6]['search']['value']));
        }
        if($requestData['columns'][6]['search']['value']){
            $dateto = date('Y-m-d H:i', strtotime($requestData['columns'][7]['search']['value']));
        }

       //Se há pesquisa ou não
        if( $requestData['columns'][1]['search']['value'] || $requestData['columns'][2]['search']['value'] || $requestData['columns'][3]['search']['value'])
        {
                $total = RecordsModel::where('visitor_id', 'LIKE', $requestData['columns'][1]['search']['value'])
                                ->where('enterprise_id', 'LIKE', $requestData['columns'][2]['search']['value'])
                                ->where('destination_id', 'LIKE', $requestData['columns'][3]['search']['value'])
                                ->whereBetween('date_entrance', [$datefrom, $dateto])
                                ->get();

                $records = RecordsModel::where('visitor_id', 'LIKE', $requestData['columns'][1]['search']['value'])
                                ->where('enterprise_id', 'LIKE', $requestData['columns'][2]['search']['value'])
                                ->where('destination_id', 'LIKE', $requestData['columns'][3]['search']['value'])
                                ->whereBetween('date_entrance', [$datefrom, $dateto])
                                ->orderBy($columns[$requestData['order'][0]['column']], $requestData['order'][0]['dir'] )
                                ->offset( $requestData['start'])->take($requestData['length'])->get();

                                $rows = count($total);

                                $filtered = count(RecordsModel::all());

        }
        else
        {
            //Obtendo registros de número total sem qualquer pesquisa
            $rows = count(RecordsModel::all());

            $records = RecordsModel::orderBy($columns[$requestData['order'][0]['column']], $requestData['order'][0]['dir'] )->offset( $requestData['start'])->take($requestData['length'])->get();

            $filtered = count($records);
        }


        // Ler e criar o array de dados
       $registers = array();
        foreach ($records as $record){
            $val = array();
            $val[] = "<img class='img-circle img-size-35' src='".$record->visitor->photo."'>";
            $val[] = strtoupper($record->visitor->name);
            $val[] = "<i style='color:".$record->destination->color."' class='m-r-15 fas fa-circle'></i>".$record->destination->destination;
            $val[] = $record->reason;
            $val[] = $record->registred_by;
            $val[] = $record->finished_by;
            $val[] = date('d/m/Y  H:m', strtotime($record->date_entrance));
           if($record->status == 2){
                $val[] = 'Ficou na OM após término de expediente';
           }else {
                $val[] =  date('d/m/Y  H:m', strtotime($record->date_exit));
           }
            $val[] = "
                <button class='btn btn-primary' title='Ver perfil do visitante'  data-toggle='modal' data-target='#visitor_profile'
                        data-id='".$record->visitor->id."'><i class='fa fa-user'></i></button>
            ";
            $registers[] = $val;
        }


        //Cria o array de informações a serem retornadas para o Javascript
        $json_data = array(
            "draw" => intval($requestData['draw']),//para cada requisição é enviado um número como parâmetro
            "recordsTotal" => intval( $filtered ),  //Quantidade de registros que há no banco de dados
            "recordsFiltered" => intval($rows ), //Total de registros quando houver pesquisa
            "data" => $registers  //Array de dados completo dos dados retornados da tabela
        );

        return json_encode($json_data);  //enviar dados como formato json
    }

    //=============================={   }================================//
    //=============================={   }================================//
    //=============================={   }================================//
    //=============================={   }================================//
}
