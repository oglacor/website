<?php

namespace App\Models;

use CodeIgniter\Model;

class BlogPostModel extends Model
{
    protected $table            = 'blog_posts';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $allowedFields    = [
        'title', 'slug', 'excerpt', 'body', 'category', 'featured_image',
        'status', 'seo_title', 'seo_description', 'published_at',
    ];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules = [
        'id'    => 'permit_empty|is_natural',
        'title' => 'required|min_length[3]|max_length[255]',
        'slug'  => 'required|alpha_dash|max_length[255]|is_unique[blog_posts.slug,id,{id}]',
        'body'  => 'required',
        'status'=> 'required|in_list[draft,published]',
    ];

    public function published()
    {
        return $this->where('status', 'published')
                     ->where('published_at <=', date('Y-m-d H:i:s'))
                     ->orderBy('published_at', 'DESC');
    }

    public function findBySlug(string $slug)
    {
        return $this->where('slug', $slug)->where('status', 'published')->first();
    }
}
