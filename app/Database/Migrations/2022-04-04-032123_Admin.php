<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Admin extends Migration
{
    public function up()
    {
        $this->forge->addField([

            'id' => [
                'type'              => 'int',
                'constraint'        => 11,
                'unsigned'          => true,
                'auto_increment'    =>true
            ],
            'name' => [
                'type'              => 'varchar',
                'constraint'        => 50
            ],
            'email' => [
                'type'              => 'varchar',
                'constraint'        => 50,
                'unique'            => true
            ],
            'bidang' =>[
                'type'              => 'ENUM',
                'constraint'        =>['finance','marketing','hr']
            ],

            'alamat' => [
                'type'              => 'varchar',
                'constraint'        => 100
            ]
        ]);

        $this->forge->addKey('id',true);

        $this->forge->createTable('admin');
    }

    public function down()
    {
        $this->forge->dropTable('admin');
    }
}
