<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\EnterpriseModel;
use App\Models\RecordsModel;
use App\Models\VisitorsModel;
use Illuminate\Http\Request;

class VisitorsController extends Controller
{
    //=============================={  VIEW LISTA }================================//
    public function visitors()
    {
        $data = [
            'enterprises' =>EnterpriseModel::all()
        ];
        return view('visitors',$data);

    }

    //=============================={  BUSCANDO PERFIL  }================================//
    public function get_profile($id)
    {
        return VisitorsModel::withTrashed()->with('enterprise')->find($id);
    }
    //=============================={ TROCAR IMAGEM PERFIL }================================//
    public function edit_img_profile(Request $request)
    {
        $data = $request->all();

        $visitor = VisitorsModel::find($data['id']);
        $visitor->photo = $data['photo'];
        $visitor->save();
    }

    //=============================={ EDITAR EMPRESA }================================//
    public function edit_enterprise_visitor(Request $request)
    {
        $data = $request->all();

        $visitor = VisitorsModel::find($data['id']);
        $visitor->enterprise_id = $data['enterprise_id'];
        $visitor->save();
    }
    //========================{ ADICIONANDO NOVO VISITANTE }==========================//
    public function add_visitor(Request $request)
    {
        $data = $request->all();

        $checkVisitor = VisitorsModel::where('cpf', str_replace(['.', '-',' '], '', $data['cpf']))->first();
        if($checkVisitor)
        {
            return 'error';
        }else{
            $visitor = new VisitorsModel();

            $visitor->name = $data['name'];
            $visitor->phone = str_replace(['(',')', '-',' '], '', $data['phone']);
            $visitor->cnh = $data['cnh'];
            $visitor->enterprise_id = $data['enterprise_id'];
            $visitor->cpf = str_replace(['.', '-',' '], '', $data['cpf']);
            $visitor->photo = $data['image_profile'];
            $visitor->save();
        }



    }
    //=============================={ DELETA O VISITANTE }================================//
    public function delete_visitor($id)
    {
        VisitorsModel::find($id)->delete();
    }

    //=============================={ DataTables }================================//
    public function get_visitors(Request $request)
    {
        //Receber a requisão da pesquisa
       $requestData = $request->all();

        //Indice da coluna na tabela visualizar resultado => nome da coluna no banco de dados
        $columns = array(
            0=> 'id',
            1 =>'name',
            2 => 'cpf',
            3=> 'phone',
            4=> 'cnh',
            5=> 'enterprise'
        );

       //Obtendo registros de número total sem qualquer pesquisa
       $rows = count(VisitorsModel::all());

       //Se há pesquisa ou não
        if( $requestData['search']['value'] )
        {
            $visitors = VisitorsModel::orWhere('name', 'LIKE', '%'.$requestData['search']['value'] .'%')->orWhere('phone', 'LIKE', '%'.$requestData['search']['value'] .'%')->orWhere('cpf', 'LIKE', '%'.$requestData['search']['value'] .'%')->get();
            $filtered = count($visitors);
        }
        else
        {
            $visitors = VisitorsModel::orderBy($columns[$requestData['order'][0]['column']], $requestData['order'][0]['dir'] )->offset( $requestData['start'])->take($requestData['length'])->get();
            $filtered = count($visitors);
        }



        // Ler e criar o array de dados
        $dados = array();
        foreach ($visitors as $visitor){
            $dado = array();
            $dado[] =  "<img class='img-circle img-size-35' src='".$visitor->photo."'>";
            $dado[] = $visitor->name;
            $dado[] = $visitor->phone;
             switch ($visitor->cnh) {
                    case 1:
                            $dado[] = 'Sim';
                        break;

                    default:
                            $dado[] = 'Não';
                        break;
            }
            $dado[] = "
                <button class='btn btn-primary' title='Ver perfil do visitante'  data-toggle='modal' data-target='#visitor_profile'
                         data-id='".$visitor->id."'><i class='fa fa-user'></i></button>
                <button class='btn btn-danger' title='Excluir visitante' onclick='return delete_visitor(".$visitor->id.")'><i class='fa fa-trash'></i></button>";
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
