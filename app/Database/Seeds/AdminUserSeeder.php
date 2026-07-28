<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

/**
 * Seeds one admin login for local dev so /admin and /docs/developer are
 * reachable without manually inserting a row. Change this password before
 * this site is ever exposed outside localhost.
 */
class AdminUserSeeder extends Seeder
{
    public function run()
    {
        $exists = $this->db->table('users')->where('email', 'admin@bluerabbit.io')->get()->getRow();

        if ($exists) {
            return;
        }

        $now = date('Y-m-d H:i:s');

        $this->db->table('users')->insert([
            'name'          => 'Bernardo',
            'email'         => 'admin@bluerabbit.io',
            'password_hash' => password_hash('ChangeMe123!', PASSWORD_DEFAULT),
            'role'          => 'admin',
            'status'        => 'active',
            'created_at'    => $now,
            'updated_at'    => $now,
        ]);
    }
}
