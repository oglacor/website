<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBlogPosts extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'             => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'title'          => ['type' => 'VARCHAR', 'constraint' => 255],
            'slug'           => ['type' => 'VARCHAR', 'constraint' => 255],
            'excerpt'        => ['type' => 'VARCHAR', 'constraint' => 500, 'null' => true],
            'body'           => ['type' => 'TEXT'],
            'category'       => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'featured_image' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'status'         => ['type' => 'VARCHAR', 'constraint' => 20, 'default' => 'draft'], // draft | published
            'seo_title'      => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'seo_description'=> ['type' => 'VARCHAR', 'constraint' => 500, 'null' => true],
            'published_at'   => ['type' => 'DATETIME', 'null' => true],
            'created_at'     => ['type' => 'DATETIME', 'null' => true],
            'updated_at'     => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('slug');
        $this->forge->addKey('status');
        $this->forge->createTable('blog_posts');
    }

    public function down()
    {
        $this->forge->dropTable('blog_posts');
    }
}
