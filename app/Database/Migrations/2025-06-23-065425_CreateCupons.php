<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCupons extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'         => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'codigo'     => ['type' => 'VARCHAR', 'constraint' => '50', 'unique' => true],
            'desconto'   => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'minimo'     => ['type' => 'DECIMAL', 'constraint' => '10,2', 'default' => 0],
            'validade'   => ['type' => 'DATE'],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('cupons');
    }
    
    public function down()
    {
        $this->forge->dropTable('cupons');
    }
    public function getMigrationName(): string
    {
        return 'CreateCupons';
    }
    
}
