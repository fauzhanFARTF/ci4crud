<?php

namespace App\Controllers;

class Pegawai extends BaseController
{   
    function __construct(){
        $this->model = new \App\Models\ModelPegawai();
    }
    public function simpan(){
        $validasi = \Config\Services::validation();
        $aturan = [
            'nama' => [
                'label' => 'Nama',
                'rules' => 'required|min_length[5]',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'min_length' => 'Minimum karakter untuk field {field} adalah 5 karakter'
                ]
            ],
            'email' => [
                'label' => 'Email',
                'rules' => 'required|min_length[5]|valid_email',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'min_length' => 'Minimum karakter untuk field {field} adalah 5 karakter',
                    'valid_email' => 'Email yang kamu masukan tidak valid'
                ]
            ],
            'alamat' => [
                'label' => 'Alamat',
                'rules' => 'required|min_length[5]',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'min_length' => 'Minimum karakter untuk field {field} adalah 5 karakter'
                ]
            ]
        ];
        $validasi ->setRules($aturan);
        if($validasi -> withRequest($this->request)->run()){
            $nama = $this->request->getPost('nama');
            $email = $this->request->getPost('email');
            $bidang = $this->request->getPost('bidang');
            $alamat = $this->request->getPost('alamat');

            $data = [
                'nama' => $nama,
                'email' => $email,
                'bidang' => $bidang,
                'alamat' => $alamat
            ];

            $this->model->save($data);

            $hasil['sukses'] = "Berhasil Memasukan Data";
            $hasil['error'] = true;
        } else {
            $hasil['sukses'] = false;
            $hasil['error'] = $validasi->listErrors();
        }
        return json_encode($hasil);
    }
    public function index()
    {
        $jumlahBaris = 5;
        $katakunci = $this->request->getGet('katakunci');
        if($katakunci){
            $pencarian = $this->model->cari($katakunci);
        } else {
            $pencarian = $this->model;
        }
        $data['katakunci'] = $katakunci;
        $data['dataPegawai'] = $pencarian->orderBy('id','desc')->paginate($jumlahBaris);
        $data['pager'] = $this->model->pager;
        $data['jumlahBaris'] = $jumlahBaris ;
        $data['nomor'] = $this->request->getVar('page') ? $this->request->getVar('page') : 1 ;
        return view('pegawai_view', $data);
    }
}