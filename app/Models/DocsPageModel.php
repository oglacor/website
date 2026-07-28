<?php

namespace App\Models;

use CodeIgniter\Model;

class DocsPageModel extends Model
{
    protected $table            = 'docs_pages';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['title', 'slug', 'section', 'body', 'status', 'sort_order'];
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';

    protected $validationRules = [
        'id'      => 'permit_empty|is_natural',
        'title'   => 'required|min_length[3]|max_length[255]',
        'slug'    => 'required|alpha_dash|max_length[255]|is_unique[docs_pages.slug,id,{id}]',
        'section' => 'required|in_list[user,setup,developer]',
        'body'    => 'required',
        'status'  => 'required|in_list[draft,published]',
    ];

    public function published()
    {
        return $this->where('status', 'published')->orderBy('sort_order', 'ASC')->orderBy('title', 'ASC');
    }

    public function publishedBySection(string $section)
    {
        return $this->published()->where('section', $section)->findAll();
    }

    public function findBySlug(string $slug)
    {
        return $this->where('slug', $slug)->where('status', 'published')->first();
    }
}
