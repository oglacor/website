<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * Password reset tokens.
 *
 * A separate table rather than columns on `users` so that issuing, expiring
 * and auditing resets never touches the account row itself, and so a user can
 * have their outstanding tokens revoked wholesale without an UPDATE on users.
 *
 * `token_hash` stores a SHA-256 of the token, never the token itself. The raw
 * value exists only in the emailed link. Anyone who reads this table — a DB
 * dump, a backup, a compromised replica — still cannot reset anybody's
 * password, which is the same reasoning as never storing raw passwords.
 */
class CreatePasswordResets extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'         => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'user_id'    => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'token_hash' => ['type' => 'VARCHAR', 'constraint' => 64],
            'expires_at' => ['type' => 'DATETIME'],
            'used_at'    => ['type' => 'DATETIME', 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('token_hash');
        $this->forge->addKey('user_id');
        $this->forge->createTable('password_resets');
    }

    public function down()
    {
        $this->forge->dropTable('password_resets');
    }
}
