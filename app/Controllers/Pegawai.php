<?php

namespace App\Controllers;

use App\Models\ModelPegawai;

class Pegawai extends BaseController
{
	function __construct()
	{
		$this->model = new ModelPegawai();
	}
	
	public function simpan()
	{
		$validasi  = \Config\Services::validation();
		$aturan = [
			'nama' => [
				'label' => 'Nama',
				'rules' => 'required|min_length[4]',
				'errors' => [
					'required' => '{field} harus diisi',
					'min_length' => 'Minimum karakter untuk field {field} adalah 4 karakter'
				]
			],
			'email' => [
				'label' => 'Email',
				'rules' => 'required|min_length[4]|valid_email',
				'errors' => [
					'required' => '{field} harus diisi',
					'min_length' => 'Minimum karakter untuk field {field} adalah 4 karakter',
					'valid_email' => 'Email yang kamu masukkan tidak valid'
				]
			],
			'alamat' => [
				'label' => 'Alamat',
				'rules' => 'required|min_length[4]',
				'errors' => [
					'required' => '{field} harus diisi',
					'min_length' => 'Minimum karakter untuk field {field} adalah 4 karakter'
				]
			],
		];

		$validasi->setRules($aturan);
		if ($validasi->withRequest($this->request)->run()) {
			$id = $this->request->getPost('id');
			$nama = $this->request->getPost('nama');
			$email = $this->request->getPost('email');
			$bidang = $this->request->getPost('bidang');
			$alamat = $this->request->getPost('alamat');

			$data = [
				'id' => $id,
				'nama' => $nama,
				'email' => $email,
				'bidang' => $bidang,
				'alamat' => $alamat
			];
			$this->model->save($data);

			$hasil['sukses'] = "Berhasil memasukkan data";
			$hasil['error'] = true;
		} else {
			$hasil['sukses'] = false;
			$hasil['error'] = $validasi->listErrors();
		}

		return json_encode($hasil);
	}
	public function index()
	{
		$jumlahBaris = 2;
		$data['dataPegawai'] = $this->model->orderBy('id', 'asc')->paginate($jumlahBaris);
		$data['pager'] = $this->model->pager;
		$data['nomor'] = ($this->request->getVar('page') == 1) ? '0' : $this->request->getVar('page');
		return view('pegawai_view', $data);
	}
}