<?php

namespace App\Controllers;

use App\Models\ModelPegawai;

class Pegawai extends BaseController
{

    function __construct()
    {
        $this->model = new ModelPegawai();
    }
    public function index()
    {
        return view('pegawai_view');
    }
}
