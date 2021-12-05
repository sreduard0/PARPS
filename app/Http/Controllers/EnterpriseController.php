<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\EnterpriseModel;
use Illuminate\Http\Request;

class EnterpriseController extends Controller
{
    //View
    function enterprise()
    {
        return view('enterprise');
    }

    //================================={ Excluir empresa }====================================//
    public function delete_enterprise($id)
    {
        EnterpriseModel::find($id)->delete();
    }

    //================================={ ADD EMPRESA }====================================//
    public function add_enterprise(Request $request)
    {
        $data = $request->all();

        $checkExists = EnterpriseModel::orWhere('name', 'LIKE', '%'.$data['enterprise'].'%')->first();

        if($checkExists)
        {
            return 'error';
        }else
        {
            $enterprise = new EnterpriseModel;
            $enterprise->name = $data['enterprise'];
            $enterprise->phone =  str_replace(['(',')', '-',' '], '', $data['phone']);
            $enterprise->address = $data['street'].", N° ".$data['number'].", Bairro ".$data['district'].", ".$data['city'];
            $enterprise->save();

        }

    }

    //================================={ editar EMPRESA }====================================//
    public function edit_enterprise(Request $request)
    {
        $data = $request->all();
        $checkExists = EnterpriseModel::where('name', $data['new_name'])->first();

        if(empty($checkExists) || $checkExists->id == $data['id'] )
        {
            $enterprise = EnterpriseModel::find($data['id']);
            $enterprise->name = $data['new_name'];
            $enterprise->phone =  str_replace(['(',')', '-',' '], '', $data['new_phone']);
            $enterprise->address = $data['new_address'];
            $enterprise->save();
        }
        else{
        return 'error';
        }


    }

    //================================={ info empresa }====================================//
    public function info_enterprise($id)
    {
        return EnterpriseModel::find($id);
    }

    //================================={ RETORNA JSON DE EMPRESAS }====================================//
    public function enterprises_json()
    {
        $enterprises = EnterpriseModel::all();
        foreach ($enterprises as $enterprise){
           $data = array();
            $data['value'] = $enterprise->id;
            $data['text'] = $enterprise->name;
            $json[] = $data;
        }
        return $json;
    }

    //================================={ DataTables }====================================//
    public function get_enterprises(Request $request)
    {
        //Receber a requisão da pesquisa
       $requestData = $request->all();

        //Indice da coluna na tabela visualizar resultado => nome da coluna no banco de dados
        $columns = array(
            0=> 'id',
            1 =>'name',
            2 => 'phone',
            3=> 'address',
            4=> 'created_at',
        );

       //Obtendo registros de número total sem qualquer pesquisa
       $rows = count(EnterpriseModel::all());

       //Se há pesquisa ou não
        if( $requestData['search']['value'] )
        {
            $enterprises = EnterpriseModel::orWhere('name', 'LIKE', '%'.$requestData['search']['value'] .'%')->get();
            $filtered = count($enterprises);
        }
        else
        {
            $enterprises = EnterpriseModel::orderBy($columns[$requestData['order'][0]['column']], $requestData['order'][0]['dir'] )->offset( $requestData['start'])->take($requestData['length'])->get();
            $filtered = count($enterprises);
        }


        // Ler e criar o array de dados
        $dados = array();
        $i = 1;
        foreach ($enterprises as $enterprise){
            $dado = array();
            $dado[] = $i++;
            $dado[] = $enterprise->name;
            $dado[] = $enterprise->phone;
            $dado[] = $enterprise->address;
            $dado[] = "
            <button class='btn btn-primary'  data-toggle='modal' data-target='#enterprise_edit' data-id='".$enterprise->id."'><i class='fa fa-pen '></i></button>
            <button class='btn btn-danger' title='Excluir empresa' onclick='return confirm_delete(".$enterprise->id.")'><i class='fa fa-trash'></i></button>
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





    //==========================================={REPORTS}===========================================//

    //================================={ Lista reports }====================================//
       public function reports_enterprise()
    {
        return view('reports_enterprise');
    }


}
