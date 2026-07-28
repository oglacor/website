<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateWaitlistSignups extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'           => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'email'        => ['type' => 'VARCHAR', 'constraint' => 255],
            'source'       => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true], // where they signed up from
            'status'       => ['type' => 'VARCHAR', 'constraint' => 20, 'default' => 'subscribed'], // subscribed | unsubscribed
            'notified_at'  => ['type' => 'DATETIME', 'null' => true], // last campaign send
            'created_at'   => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('email');
        $this->forge->createTable('waitlist_signups');
    }

    public function down()
    {
        $this->forge->dropTable('waitlist_signups');
    }
}
