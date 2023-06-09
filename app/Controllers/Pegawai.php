<?php

namespace App\Controllers;

class Pegawai extends BaseController
{   
    function __construct(){
        $this->model = new \App\Models\ModelPegawai();
    }
    public function simpan(){
        return "Saya dari fungsi simpan";
    }
    public function index()
    {
        return view('pegawai_view');
    }
}