<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateDocsPages extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'title'       => ['type' => 'VARCHAR', 'constraint' => 255],
            'slug'        => ['type' => 'VARCHAR', 'constraint' => 255],
            'section'     => ['type' => 'VARCHAR', 'constraint' => 20, 'default' => 'user'], // user | setup | developer
            'body'        => ['type' => 'TEXT'],
            'status'      => ['type' => 'VARCHAR', 'constraint' => 20, 'default' => 'draft'], // draft | published
            'sort_order'  => ['type' => 'INT', 'constraint' => 11, 'default' => 0],
            'created_at'  => ['type' => 'DATETIME', 'null' => true],
            'updated_at'  => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('slug');
        $this->forge->addKey('section');
        $this->forge->addKey('status');
        $this->forge->createTable('docs_pages');
    }

    public function down()
    {
        $this->forge->dropTable('docs_pages');
    }
}
