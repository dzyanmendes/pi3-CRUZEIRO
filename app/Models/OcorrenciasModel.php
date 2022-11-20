<?php

namespace App\Models;

use CodeIgniter\Model;

class OcorrenciasModel {

    protected $DBGroup = 'default';
    protected $table = 'Ocorrencias';
    protected $primarKey = 'codigo';
    protected $autoincrement = true;
    protected $insertID = 0;
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected $protectFields=true;
    protected $allowedFields=[
                                'codigo',
                                'localidade_codigo',
                                'enfermidade_codigo',
                                'dataOcorrencia',
                                'sexo',
                                'ano_nasc',
                                'observacao'
    ];

    // Dates
    protected $useTimeStamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deletec_at';

    // Validation
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = false;
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];

    public function testeBd() {
        $db = \Config\Database::connect();
        //$sql = file_get_contents(__DIR__ . '\SQL\Ocorrencias_testar.sql');
        $sql='select * from Ocorrencias';
        $query = $db->query($sql);
        $resultado = $query->getResultArray();
        return $resultado;
    }

    public function listarOcorrencias() {
        $db = \Config\Database::connect();
        //$sql = file_get_contents(__DIR__ . '\SQL\Ocorrencias_listar_todos.sql');
        $sql='select Ocorrencias.*,
                     Localidades.nome localidade,
                     Enfermidades.descricao enfermidade 
                from Ocorrencias
                left join Localidades on Localidades.codigo=Ocorrencias.localidade_codigo
                left join Enfermidades on Enfermidades.codigo=Ocorrencias.enfermidade_codigo
                order by Ocorrencias.codigo desc
            ';
        $query = $db->query($sql);
        $resultado = $query->getResult();
        return $resultado;
    }

    public function listarPorCodigoObject($codigo) {
        $db = \Config\Database::connect();
        //$sql = file_get_contents(__DIR__ . '\SQL\Ocorrencias_listar_especifico.sql');
        $sql='select * from Ocorrencias where codigo='.$codigo;
        $query = $db->query($sql);
        $resultado = $query->getResult();
        return $resultado;
    }

    public function listarPorCodigoArray($codigo) {
        $db = \Config\Database::connect();
        //$sql = file_get_contents(__DIR__ . '\SQL\Ocorrencias_alterar.sql');
        $sql='select * from Ocorrencias where codigo='.$codigo;
        $query = $db->query($sql);
        $resultado = $query->getResult();
        return $resultado;
    }    

    public function excluir($codigo) {
        $db = \Config\Database::connect();
        //$sql = file_get_contents(__DIR__ . '\SQL\Ocorrencias_excluir.sql');
        $table=$db->table($this->table);
        $table->where('codigo',$codigo);
        if($table->delete()){
            return true;
        }
        return false;
    }    

    public function inserir($dados) {
        $db = \Config\Database::connect();
        //$sql = file_get_contents(__DIR__ . '\SQL\Ocorrencias_excluir.sql');
        
        if($db->table($this->table)->insert($dados)){
            return true;
        }
        return false;
    }    

    public function update($dados) {
        $db = \Config\Database::connect();
        //$sql = file_get_contents(__DIR__ . '\SQL\Ocorrencias_excluir.sql');
        
        $table=$db->table($this->table);
        $table->where('codigo',$dados['codigo']);
        if($table->update($dados)){
            return true;
        }
        return false;
    }    
}