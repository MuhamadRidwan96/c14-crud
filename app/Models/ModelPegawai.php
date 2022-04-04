<?php namespace App\Models;

use CodeIgniter\Model;

class ModelPegawai extends Model{

protected $table = "pegawai";
protected $primarykey = "id";
protected $allowedFields = [
    'name',
    'email',
    'bidang',
    'alamat'
];


}