<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePedidos extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'            => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'cliente_nome'  => ['type' => 'VARCHAR', 'constraint' => '255'],
            'cliente_email' => ['type' => 'VARCHAR', 'constraint' => '255'],
            'cep'           => ['type' => 'VARCHAR', 'constraint' => '9'],
            'endereco'      => ['type' => 'VARCHAR', 'constraint' => '255'],
            'subtotal'      => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'frete'         => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'desconto'      => ['type' => 'DECIMAL', 'constraint' => '10,2', 'default' => 0],
            'total'         => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'status'        => ['type' => 'VARCHAR', 'constraint' => '50', 'default' => 'Pendente'],
            'created_at'    => ['type' => 'DATETIME', 'null' => true],
            'updated_at'    => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('pedidos');
    }
    
    public function down()
    {
        $this->forge->dropTable('pedidos');
    }
    public function getMigrationName(): string
    {
        return 'CreatePedidos';
    }    
}
