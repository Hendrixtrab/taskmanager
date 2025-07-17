<?php

/*
    Arquivo que cria a tabela "tasks" no banco de dados, através das migrations,
    a base da tabela mysql para a criação da migration foi:

        CREATE TABLE tasks (
            id INT AUTO_INCREMENT PRIMARY KEY,
            title VARCHAR(255) NOT NULL,
            description TEXT,
            status ENUM('pendente', 'em andamento', 'concluída') DEFAULT 'pendente',
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE
            CURRENT_TIMESTAMP
        );
*/

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Task extends Migration
{
    public function up()
    {
        //Configurações para a criação da tabela "tasks"
        $this->forge->addField([
            'id'=> [
                'type' => 'INT',
                'auto_increment' => true
                //'unique' => true,    -> Definindo como chave primária, o campo já será único
                //'null' => false      -> Por padrão já é FALSE
            ],
            'title'=> [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['pendente', 'em andamento', 'concluída'],
                'default' => 'pendente',
                'null' => true
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true
            ]

        ]);

        //Define a chave primária
        $this->forge->addPrimaryKey('id');
        //Cria a tabela no banco de dados
        $this->forge->createTable('tasks', true, ['engine' => 'innodb']);
    }

    public function down()
    {
        //Exclusão da tabela
        $this->forge->dropTable('tasks');
    }
}
