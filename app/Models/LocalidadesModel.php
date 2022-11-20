<?php

namespace App\Models;

use CodeIgniter\Model;

class LocalidadesModel {

    protected $DBGroup = 'default';
    protected $table = 'Localidades';
    protected $primarKey = 'codigo';
    protected $autoincrement = true;
    protected $insertID = 0;
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected $protectFields=true;
    protected $allowedFields=[
                                'codigo',
                                'cep',
                                'latitude',
                                'longitude',
                                'nome',
                                'bairro',
                                'cidade',
                                'estado',
                                'pais'
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
        //$sql = file_get_contents(__DIR__ . '\SQL\Localidades_testar.sql');
        $sql='select * from Localidades';
        $query = $db->query($sql);
        $resultado = $query->getResultArray();
        return $resultado;
    }

    public function listarLocalidades() {
        $db = \Config\Database::connect();
        //$sql = file_get_contents(__DIR__ . '\SQL\Localidades_listar_todos.sql');
        $sql='select * from Localidades';
        $query = $db->query($sql);
        $resultado = $query->getResult();
        return $resultado;
    }

    public function listarPorCodigoObject($codigo) {
        $db = \Config\Database::connect();
        //$sql = file_get_contents(__DIR__ . '\SQL\Localidades_listar_especifico.sql');
        $sql='select * from Localidades where codigo='.$codigo;
        $query = $db->query($sql);
        $resultado = $query->getResult();
        return $resultado;
    }

    public function listarPorCodigoArray($codigo) {
        $db = \Config\Database::connect();
        //$sql = file_get_contents(__DIR__ . '\SQL\Localidades_alterar.sql');
        $sql='select * from Localidades where codigo='.$codigo;
        $query = $db->query($sql);
        $resultado = $query->getResult();
        return $resultado;
    }    

    public function excluir($codigo) {
        $db = \Config\Database::connect();
        //$sql = file_get_contents(__DIR__ . '\SQL\Localidades_excluir.sql');
        $table=$db->table($this->table);
        $table->where('codigo',$codigo);
        if($table->delete()){
            return true;
        }
        return false;
    }    

    public function inserir($dados) {
        $db = \Config\Database::connect();
        //$sql = file_get_contents(__DIR__ . '\SQL\Localidades_excluir.sql');
        
        if($db->table($this->table)->insert($dados)){
            return true;
        }
        return false;
    }    

    public function update($dados) {
        $db = \Config\Database::connect();
        //$sql = file_get_contents(__DIR__ . '\SQL\Localidades_excluir.sql');
        
        $table=$db->table($this->table);
        $table->where('codigo',$dados['codigo']);
        if($table->update($dados)){
            return true;
        }
        return false;
    }    
}