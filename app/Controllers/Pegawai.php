<?php namespace App\Controllers;

class Pegawai extends BaseController{

    function __construct()
    {
        $this->models = new \App\Models\ModelPegawai();

    }

    function delete($id){
        
        $this->models->delete($id);

        return redirect()->to('pegawai');

    }

    function edit($id){

        return json_encode($this->models->find($id));
    }

    function save(){

        $validation = \Config\Services::validation();
        $rules = [
            'nama' => [
                'label' => 'Nama',
                'rules' => 'required|min_length[5]',
                'error' => [
                    'required' => '{field} harus di isi',
                    'min_length' => 'Minimum karakter untuk field {field} adalah 5 karakter'
                ]
                ],
                'email' => [
                    'label' => 'Email',
                    'rules' => 'required|valid_email',
                    'error' => [
                        'required' => '{field} harus di isi',
                        'valid_email' => 'email anda tidak valid'
                    ]
                    ],
                    'alamat' => [
                        'label' => 'Alamat',
                        'rules' => 'required|min_length[5]',
                        'error' => [
                            'required' => '{filed} harus di isi',
                            'min_length' => 'Minimum karakter untuk field {field} adalah 5 karakter'
                        ]
                    ]
            ];
            $validation->setRules($rules);
            if($validation->withRequest($this->request)->run()){
        
                $id = $this->request->getPost('id');
                $nama = $this->request->getPost('nama');
                $email = $this->request->getPost('email');
                $bidang = $this->request->getPost('bidang');
                $alamat = $this->request->getPost('alamat');

                $data = [
                    'id'=> $id,
                    'nama' => $nama,
                    'email' => $email,
                    'bidang' => $bidang,
                    'alamat' => $alamat
                ];

                $this->models->save($data);

                $hasil['sukses'] = "Berhasil Menambahkan Data";
                $hasil['error'] = true;

            } else {

                $hasil['sukses'] = false;
                $hasil['error'] = $validation->listErrors();
            }

            return json_encode($hasil);

    }

    public function index(){

        $katakunci = $this->request->getGet('katakunci');
        if($katakunci){
            $search = $this->models->search($katakunci);
        } else {
            $search = $this->models;
        }
        $data = [
            'katakunci' => $katakunci,
            'dataPegawai' => $search->orderBy('id','asc')->paginate(7),
            'pager' => $this->models->pager,
            'nomor' => ($this->request->getVar('page')==1) ? '0': $this->request->getVar('nomor')
        ];
        return view('pegawai_view',$data);
    }



}