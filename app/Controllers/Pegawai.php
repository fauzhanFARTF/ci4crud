<?php

namespace App\Controllers;

class Pegawai extends BaseController
{   
    function __construct(){
        $this->model = new \App\Models\ModelPegawai();
    }
    public function simpan(){
        $hasil['sukses'] = false;
        $hasil['error'] = "Ada error terjadi";
        return json_encode($hasil);
    }
    public function index()
    {
        return view('pegawai_view');
    }
}