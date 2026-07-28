<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateContactMessages extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'         => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'name'       => ['type' => 'VARCHAR', 'constraint' => 150],
            'email'      => ['type' => 'VARCHAR', 'constraint' => 255],
            'subject'    => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'message'    => ['type' => 'TEXT'],
            'status'     => ['type' => 'VARCHAR', 'constraint' => 20, 'default' => 'new'], // new | read
            'created_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey('status');
        $this->forge->createTable('contact_messages');
    }

    public function down()
    {
        $this->forge->dropTable('contact_messages');
    }
}
