<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    //private $model;

    public function __construct()
    {
        //$model = new \App\Models\LocalidadesModel();
        //https://nominatim.openstreetmap.org/search?q=Vila%20Canevari,%20Cruzeiro,%20SP&format=json
    }


    public function index($indice=NULL,$funcao=NULL)
    {
        echo view('layout/header' );
        echo view('layout/dashboard');
        echo view('layout/footer');
    }
}
