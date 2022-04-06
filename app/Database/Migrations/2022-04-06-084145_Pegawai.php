<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pegawai extends Migration
{
    public function up()
    {
        $this->forge->addField([

            'id' => [

                'type' => 'int',
                'constraint' => 11,
                'auto_increment'=>true

            ],
            'nama' => [
                'type' => 'varchar',
                'constraint'=>100,
            ],
            'email' => [
                'type' => 'varchar',
                'constraint' =>100,
                'unique'=>true
            ],
            'bidang' => [
                'type'=>'ENUM',
                'constraint'=>['finance','marketing','hr']
            ],
            'alamat' => [
                'type' => 'varchar',
                'constraint' =>100
            ]
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('pegawai');
    }

    public function down()
    {
        $this->forge->dropTable('pegawai');
    }
}
