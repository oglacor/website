<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(AdminUserSeeder::class);
        $this->call(BlogPostSeeder::class);
        $this->call(DocsPageSeeder::class);
    }
}
