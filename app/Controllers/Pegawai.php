<?php

namespace App\Controllers;

use App\Models\ModelPegawai;

class Pegawai extends BaseController
{

    function __construct()
    {
        $this->model = new ModelPegawai();
    }

    public function simpan(){

        $validasi =\Config\Services::validation();
        $aturan = [
            'nama'=>[
                'label' => 'nama',
                'rules' => 'required|min_length(5)',
                'errors' => [
                    'required' => '(field) harus di isi',
                    'min_length' => 'minimum field adalah 5 karakter'
                ]
                ],
                'email'=>[
                    'label'=>'email',
                    'rules'=> 'required|valid_email',
                    'errors' => [
                        'required' => 'silahkan masukan email',
                        'valid_email' => 'email anda tidak valid'
                    ]
                    ],
                    'alamat'=>[
                        'label' => 'alamat',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '(field) harus di isi'
                        ]
                        ],
                    ];

        $hasil['sukses'] = "berhasil";
        $hasil['error'] = true;

        return json_encode($hasil);
    }
    public function index()
    {
        return view('pegawai_view');
    }
}
