<?php

namespace App\Controllers;

use App\Models\BlogPostModel;

class Blog extends BaseController
{
    public function index(): string
    {
        $model = new BlogPostModel();
        $posts = $model->published()->paginate(9);

        return view('blog/index', [
            'title'           => 'Blog — BLUERABBIT',
            'metaDescription' => 'Notes on gamification design, product, and engineering from the BLUERABBIT team.',
            'activeNav'       => 'blog',
            'posts'           => $posts,
            'pager'           => $model->pager,
        ]);
    }

    public function show(string $slug): string
    {
        $model = new BlogPostModel();
        $post  = $model->findBySlug($slug);

        if (! $post) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('blog/show', [
            'title'           => $post['seo_title'] ?: ($post['title'] . ' — BLUERABBIT Blog'),
            'metaDescription' => $post['seo_description'] ?: $post['excerpt'],
            'activeNav'       => 'blog',
            'post'            => $post,
        ]);
    }
}
