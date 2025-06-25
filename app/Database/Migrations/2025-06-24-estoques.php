<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Estoques extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'produto_id'  => ['type' => 'INT', 'unsigned' => true],
            'quantidade'  => ['type' => 'INT', 'default' => 0],
            'created_at'  => ['type' => 'DATETIME', 'null' => true],
            'updated_at'  => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('produto_id', 'produtos', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('estoques');
    }

    public function down()
    {
        $this->forge->dropTable('estoques');
    }
}
