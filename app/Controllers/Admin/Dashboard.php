<?php

namespace App\Controllers\Admin;

use App\Models\BlogPostModel;
use App\Models\ContactMessageModel;
use App\Models\DocsPageModel;
use App\Models\WaitlistSignupModel;

class Dashboard extends AdminBaseController
{
    public function index(): string
    {
        $blog     = new BlogPostModel();
        $waitlist = new WaitlistSignupModel();
        $contact  = new ContactMessageModel();
        $docs     = new DocsPageModel();

        return view('admin/dashboard', $this->adminData('dashboard', [
            'title' => 'Admin Dashboard — BLUERABBIT',
            'stats' => [
                'posts'        => $blog->countAll(),
                'signups'      => $waitlist->countAll(),
                'newMessages'  => $contact->where('status', 'new')->countAllResults(),
                'docs'         => $docs->countAll(),
            ],
        ]));
    }
}
