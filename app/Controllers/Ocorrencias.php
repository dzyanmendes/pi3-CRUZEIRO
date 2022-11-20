<?php

namespace App\Controllers;

class Ocorrencias extends BaseController
{
    //private $model;

    public function __construct()
    {
        //$model = new \App\Models\OcorrenciasModel();
    }


    public function index($indice=NULL,$funcao=NULL)
    {
        //echo 'Você está em Controller -> Ocorrencias -> Index';
        $data['titulo'] = 'Ocorrencias - index';
        $data=[];
        $data['selecionado']=NULL;
        $method=$this->request->getMethod();
        if ($method!='get'){
            //dd($method);
        }

        $model = new \App\Models\OcorrenciasModel();
        $localidadeModel = new \App\Models\LocalidadesModel();
        $enfermidadesModel = new \App\Models\EnfermidadesModel();
        $data['localidades'] = $localidadeModel->listarLocalidades();
        $data['enfermidades'] = $enfermidadesModel->listarEnfermidades();

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
            $codigo=$this->request->getVar('codigo');
            $localidade_codigo=$this->request->getVar('localidade_codigo');
            $enfermidade_codigo=$this->request->getVar('enfermidade_codigo');
            $dataOcorrencia=$this->request->getVar('dataOcorrencia');
            $sexo=$this->request->getVar('sexo');
            $ano_nasc=$this->request->getVar('ano_nasc');
            $observacao=$this->request->getVar('observacao');
            
            //dd($descricao);
            if ($codigo==0) {
                $model->inserir(
                            [
                                "localidade_codigo"=>$localidade_codigo,
                                "enfermidade_codigo"=>$enfermidade_codigo,
                                "dataOcorrencia"=>$dataOcorrencia,
                                "sexo"=>$sexo,
                                "ano_nasc"=>$ano_nasc,
                                "observacao"=>$observacao                                
                            ]
                        );
            } else {
                $model->update(
                            [
                                "codigo"=>$codigo,
                                "localidade_codigo"=>$localidade_codigo,
                                "enfermidade_codigo"=>$enfermidade_codigo,
                                "dataOcorrencia"=>$dataOcorrencia,
                                "sexo"=>$sexo,
                                "ano_nasc"=>$ano_nasc,
                                "observacao"=>$observacao                                
                            ]
                        );
            }
        }

        $data['result'] = $model->listarOcorrencias();

        echo view('layout/header', $data);
        echo view('layout/ocorrencias',$data);
        echo view('layout/footer');
    }

    public function incluir()
    {
        //echo 'Você está em Controller -> Ocorrencias -> incluir';
        $data['titulo'] = 'Ocorrencias - incluir';
        echo view('layout/header', $data);

        //$model = new \App\Models\OcorrenciasModel();
        // $data['result'] = $model->incluirCliente();            
        $data['titulo_interno'] = 'Inclusão de Ocorrencias';
        echo view('ocorrencias/ocorrencias_incluir', $data);
        //echo 'Você está em Controller -> Ocorrencias -> incluir';
        echo view('layout/footer');
    }

    public function alterar($cliente)
    {
        //echo 'Você está em Controller -> Ocorrencias -> alterar';
        $data['titulo'] = 'Ocorrencias - alterar';
        $data['titulo_interno'] =  'Alteração de cadatro do cliente';
        echo view('layout/header', $data);

        $model = new \App\Models\OcorrenciasModel();
        $data['result'] = $model->alterarCliente($cliente);
        //dd($data);
        echo view('ocorrencias/ocorrencias_alterar', $data);

        echo view('layout/footer');
    }

    public function salvar()
    {
        //echo 'Você está em Controller -> Ocorrencias -> alterar';
        $data['titulo'] = 'Ocorrencias - alterar';
        echo view('layout/header', $data);
        $model = new \App\Models\OcorrenciasModel();
        $data = $this->request->getPost();
        unset($data['submit']);
        //dd($data);
        if ($model->salvar($data)) {
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
        //echo 'Você está em Controller -> Ocorrencias -> alterar';
        $data['titulo'] = 'Ocorrencias - alterar';
        echo view('layout/header', $data);

        $model = new \App\Models\OcorrenciasModel();
        $data = $this->request->getPost();
        unset($data['submit']);
        //dd($data);
        if ($model->salvar_update($data)) {
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
        //echo 'Você está em Controller -> Ocorrencias -> excluir';

        $data['titulo'] = 'Ocorrencias - excluir';
        echo view('layout/header', $data);


        $model = new \App\Models\OcorrenciasModel();
        //if ($model->excluirCliente($cliente)) {
        if ($model->excluirCliente($cliente)) {
            echo view('messages', [
                'message' => 'Usuário excluído com sucesso'
            ]);
        } else {
            echo 'Erro';
        }

        $data['titulo_interno'] = 'Ocorrencias - excluir';
        //echo view('nome_da_view',$data);
        echo view('ocorrencias/ocorrencias_listartodos', [
            'result' => $model->listarOcorrencias(),
            'titulo_interno' => 'Listagem de todos os Ocorrencias'
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
