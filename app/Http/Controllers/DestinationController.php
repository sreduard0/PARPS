<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DestinationModel;
use App\Models\EnterpriseModel;
use App\Models\RecordsModel;
use App\Models\VisitorsModel;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    //=============================={ LISTA DE DESTINOS }================================//
    public function destination()
    {
        return view('destination');
    }

    //=============================={ ADICIONAR DESTINO }================================//
    public function add_destination(Request $request)
    {
        $data = $request->all();

        $checkDestination = DestinationModel::where('destination', $data['destination'])->first();

        if ($checkDestination){
            return 'error';
        }else{
            $destination = new DestinationModel();

            $destination->destination = strtoupper($data['destination']);
            $destination->color = $data['color'];
            $destination->save();
        }

    }

    //=============================={ Exclui destino }================================//
    public function delete_destination($id)
    {
        DestinationModel::find($id)->delete();
    }

    //================================={ DataTables }====================================//
    public function get_destinations(Request $request)
    {
        //Receber a requisão da pesquisa
       $requestData = $request->all();

        //Indice da coluna na tabela visualizar resultado => nome da coluna no banco de dados
        $columns = array(
            0=> 'id',
            1 =>'destination',
            3 => 'color',
            4 => 'id'

        );


       //Obtendo registros de número total sem qualquer pesquisa
       $rows = count(DestinationModel::all());
       //Se há pesquisa ou não
        if( $requestData['search']['value'] )
        {
            $destinations = DestinationModel::orWhere('destination', 'LIKE', '%'.$requestData['search']['value'] .'%')->get();
            $filtered = count($destinations);
        }
        else
        {
            $destinations = DestinationModel::orderBy($columns[$requestData['order'][0]['column']], $requestData['order'][0]['dir'] )->offset( $requestData['start'])->take($requestData['length'])->get();
            $filtered = count($destinations);
        }


        // Ler e criar o array de dados
        $dados = array();
        $i = 1;
        foreach ($destinations as $destination){
            $dado = array();
            $dado[] = $i++;
            $dado[] = $destination->destination;
            $dado[] = "<i style='color:".$destination->color."' class='fs-20 fas fa-circle'></i>";
            $dado[] = "
            <button class='btn btn-danger' title='Excluir empresa' onclick='return delete_destination(".$destination->id.")'><i class='fa fa-trash'></i></button>
            ";
            $dados[] = $dado;
        }


        //Cria o array de informações a serem retornadas para o Javascript
        $json_data = array(
            "draw" => intval($requestData['draw']),//para cada requisição é enviado um número como parâmetro
            "recordsTotal" => intval( $filtered ),  //Quantidade de registros que há no banco de dados
            "recordsFiltered" => intval($rows ), //Total de registros quando houver pesquisa
            "data" => $dados   //Array de dados completo dos dados retornados da tabela
        );

        return json_encode($json_data);  //enviar dados como formato json
    }


}
