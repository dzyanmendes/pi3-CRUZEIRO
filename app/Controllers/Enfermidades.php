<?php

namespace App\Controllers;

class Enfermidades extends BaseController
{
    //private $model;

    public function __construct()
    {
        //$this->request = RequestInterface   ;
        helper('url');
    }

    public function index($indice = NULL)
    {
        //echo 'Você está em Controller -> Enfermidades -> Index';
        $data['titulo'] = 'Enfermidades - index';
        $data=[];
        $data['selecionado']=NULL;
        $method=$this->request->getMethod();
        if ($method!='get'){
            //dd($method);
        }

        $model = new \App\Models\EnfermidadesModel();
        
        if ($method=='get'){
            if ($indice!=NULL){
                $data['selecionado']=$model->listarEnfermidadesporCodigoObject($indice);
                //dd($data['selected']);
            }
        }

        if ($method=='post'){
            //dd($this->request);
            $codigo=$this->request->getVar('codigo');
            $descricao=$this->request->getVar('descricao');
            //dd($descricao);
            if ($codigo==0) {
                $model->inserir(["descricao"=>$descricao]);
            } else {
                $model->update(["codigo"=>$codigo,"descricao"=>$descricao]);
            }
        }

        $data['result']=$model->listarEnfermidades();
        
        echo view('layout/header', $data);
        echo view('layout/enfermidades', $data);
        echo view('layout/footer');
    }

    public function incluir()
    {
        //echo 'Você está em Controller -> Enfermidades -> incluir';
        $data['titulo'] = 'Enfermidades - incluir';
        echo view('layout/header', $data);

        //$model = new \App\Models\EnfermidadesModel();
        // $data['result'] = $model->incluirCliente();            
        $data['titulo_interno'] = 'Inclusão de Enfermidades';
        echo view('enfermidades/enfermidades_incluir', $data);
        //echo 'Você está em Controller -> Enfermidades -> incluir';
        echo view('layout/footer');
    }

    public function alterar($cliente)
    {
        //echo 'Você está em Controller -> Enfermidades -> alterar';
        $data['titulo'] = 'Enfermidades - alterar';
        $data['titulo_interno'] =  'Alteração de cadatro do cliente';
        echo view('layout/header', $data);

        $model = new \App\Models\EnfermidadesModel();
        $data['result'] = $model->update($cliente);
        //dd($data);
        echo view('enfermidades/enfermidades_alterar', $data);

        echo view('layout/footer');
    }

    public function salvar()
    {
        //echo 'Você está em Controller -> Enfermidades -> alterar';
        $data['titulo'] = 'Enfermidades - alterar';
        echo view('layout/header', $data);
        $model = new \App\Models\EnfermidadesModel();
        $data = $this->request->getPost();
        unset($data['submit']);
        //dd($data);
        if ($model->inserir($data)) {
            return view('messages', [
                'message' => 'Cliente cadastrado com sucesso!'
            ]);
        } else {
            echo 'Ocorreu um erro';
        }

        //$data['result'] = $model->alterarCliente($cliente);            


        echo view('layout/footer');
    }

    public function salvar_update($codigo)
    {
        //echo 'Você está em Controller -> Enfermidades -> alterar';
        $data['titulo'] = 'Enfermidades - alterar';
        echo view('layout/header', $data);

        $model = new \App\Models\EnfermidadesModel();
        $data = $this->request->getPost();
        unset($data['submit']);
        //dd($data);
        if ($model->update($data)) {
            return view('messages', [
                'message' => 'Cliente cadastrado com sucesso!'
            ]);
        } else {
            echo 'Ocorreu um erro';
        }
        echo view('layout/footer');
    }

    public function excluir($cliente)
    {
        //echo 'Você está em Controller -> Enfermidades -> excluir';

        $data['titulo'] = 'Enfermidades - excluir';
        echo view('layout/header', $data);


        $model = new \App\Models\EnfermidadesModel();
        //if ($model->excluirCliente($cliente)) {
        if ($model->excluir($cliente)) {
            echo view('messages', [
                'message' => 'Usuário excluído com sucesso'
            ]);
        } else {
            echo 'Erro';
        }

        $data['titulo_interno'] = 'Enfermidades - excluir';
        //echo view('nome_da_view',$data);
        echo view('enfermidades/enfermidades_listartodos', [
            'result' => $model->listarEnfermidades(),
            'titulo_interno' => 'Listagem de todos os Enfermidades'
        ]);
        echo view('layout/footer');
    }

    public function getCepbyAPI($cep)
    {
        $client = \Config\Services::curlRequest();

        $requestGET = $client->request('GET', 'viacep.com.br/ws/' . $cep . '/json/');

        //$dados = json_decode($requestGET->getBody());

        //return $dados;
        //dd($dados->cep);
    }
}
