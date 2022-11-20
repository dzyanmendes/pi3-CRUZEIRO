<?php

namespace App\Controllers;

class Localidades extends BaseController
{
    //private $model;

    public function __construct()
    {
        //$model = new \App\Models\LocalidadesModel();
        //https://nominatim.openstreetmap.org/search?q=Vila%20Canevari,%20Cruzeiro,%20SP&format=json
    }


    public function index($indice=NULL,$funcao=NULL)
    {
        //echo 'Você está em Controller -> Clientes -> Index';
        $data['titulo'] = 'Localidades - index';
        $data=[];
        $data['selecionado']=NULL;
        $method=$this->request->getMethod();
        if ($method!='get'){
            //if()
            //dd($method);
        }

        $model = new \App\Models\LocalidadesModel();

        if ($method=='get'){
            if ($indice!=NULL){
                if ($funcao=='delete'){
                    $model->excluir($indice);    
                } else {
                    $data['selecionado']=$model->listarPorCodigoObject($indice);
                }
                //dd($data['selected']);
            }
        }

        if ($method=='post'){
            //dd($this->request);
            $codigo     =   $this->request->getVar('codigo');
            $cep        =   $this->request->getVar('cep');
            $latitude   =   $this->request->getVar('latitude');
            $longitude  =   $this->request->getVar('longitude');
            $nome       =   $this->request->getVar('nome');
            $bairro     =   $this->request->getVar('bairro');
            $cidade     =   $this->request->getVar('cidade');
            $estado     =   $this->request->getVar('estado');
            $pais       =   $this->request->getVar('pais');
                        
            if ($codigo==0) {
                $model->inserir([
                    "cep"=>$cep,
                    "latitude"=>$latitude,
                    "longitude"=>$longitude,
                    "nome"=>$nome,
                    "bairro"=>$bairro,
                    "cidade"=>$cidade,
                    "estado"=>$estado,
                    "pais"=>$pais                    
                    ]
                );
            } else {
                $model->update(
                    [
                        "codigo"=>$codigo,
                        "cep"=>$cep,
                        "latitude"=>$latitude,
                        "longitude"=>$longitude,
                        "nome"=>$nome,
                        "bairro"=>$bairro,
                        "cidade"=>$cidade,
                        "estado"=>$estado,
                        "pais"=>$pais     
                    ]
                );
            }
        }

        $data['result']=$model->listarLocalidades();
        
        echo view('layout/header', $data);
        echo view('layout/localidades',$data);
        echo view('layout/footer');
    }

    public function incluir()
    {
        //echo 'Você está em Controller -> Clientes -> incluir';
        $data['titulo'] = 'Localidades - incluir';
        echo view('layout/header', $data);

        //$model = new \App\Models\ClientesModel();
        // $data['result'] = $model->incluirCliente();            
        $data['titulo_interno'] = 'Inclusão de Localidades';
        echo view('localidades/localidades', $data);
        //echo 'Você está em Controller -> Clientes -> incluir';
        echo view('layout/footer');
    }

    public function alterar($cliente)
    {
        //echo 'Você está em Controller -> Clientes -> alterar';
        $data['titulo'] = 'Localidades - alterar';
        $data['titulo_interno'] =  'Alteração de cadatro de Localidades';
        echo view('layout/header', $data);

        $model = new \App\Models\LocalidadesModel();
        $data['result'] = $model->alterarLocalidades($localidades);
        //dd($data);
        echo view('localidades/localidades', $data);

        echo view('layout/footer');
    }

    public function salvar()
    {
        //echo 'Você está em Controller -> Clientes -> alterar';
        $data['titulo'] = 'Localidades - alterar';
        echo view('layout/header', $data);
        $model = new \App\Models\LocalidadesModel();
        $data = $this->request->getPost();
        unset($data['submit']);
        //dd($data);
        if ($model->salvar($data)) {
            return view('messages', [
                'message' => 'Localidade cadastrada com sucesso!'
            ]);
        } else {
            echo 'Ocorreu um erro';
        }

        //$data['result'] = $model->alterarCliente($cliente);            


        echo view('layout/footer');
    }

    public function salvar_update($codigo)
    {
        //echo 'Você está em Controller -> Clientes -> alterar';
        $data['titulo'] = 'Localidades - alterar';
        echo view('layout/header', $data);

        $model = new \App\Models\LocalidadesModel();
        $data = $this->request->getPost();
        unset($data['submit']);
        //dd($data);
        if ($model->salvar_update($data)) {
            return view('messages', [
                'message' => 'Localidade cadastrada com sucesso!'
            ]);
        } else {
            echo 'Ocorreu um erro';
        }
        echo view('layout/footer');
    }

    public function excluir($cliente,$funcao=NULL)
    {
        //echo 'Você está em Controller -> Clientes -> excluir';

        $data['titulo'] = 'Localidades - excluir';
        echo view('layout/header', $data);


        $model = new \App\Models\LocalidadesModel();
        //if ($model->excluirCliente($cliente)) {
        if ($model->excluirLocalidades($localidades)) {
            echo view('messages', [
                'message' => 'Localidade excluída com sucesso'
            ]);
        } else {
            echo 'Erro';
        }

        $data['titulo_interno'] = 'Localidades - excluir';
        //echo view('nome_da_view',$data);
        echo view('layout/localidades', [
            'result' => $model->listarLocalidades(),
            'titulo_interno' => 'Listagem de todas as Localidades'
        ]);
        echo view('layout/footer');
    }

    public function getCepbyAPI($cep)
    {
        $client = \Config\Services::curlRequest();

        $requestGET = $client->request('GET', 'viacep.com.br/ws/' . $cep . '/json/');

        $dados = json_decode($requestGET->getBody());

        return $dados;
        //dd($dados->cep);
    }
}
