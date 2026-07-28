<?php

namespace App\Controllers;

use App\Models\BlogPostModel;

class Home extends BaseController
{
    public function index(): string
    {
        $posts = (new BlogPostModel())->published()->findAll(3);

        return view('pages/home', [
            'title'           => 'BLUERABBIT — Gamification Platform',
            'metaDescription' => 'BLUERABBIT is making a comeback. Get on the waitlist for the faster, AI-integrated relaunch.',
            'activeNav'       => 'home',
            'posts'           => $posts,
        ]);
    }
}
