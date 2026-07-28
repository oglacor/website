<?php

namespace App\Controllers;

use App\Models\DocsPageModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Docs extends BaseController
{
    public function index(): string
    {
        $model = new DocsPageModel();

        return view('docs/index', [
            'title'     => 'Documentation — BLUERABBIT',
            'activeNav' => 'docs',
            'userDocs'  => $model->publishedBySection('user'),
            'setupDocs' => $model->publishedBySection('setup'),
        ]);
    }

    public function show(string $slug): string
    {
        $model = new DocsPageModel();
        $doc   = $model->findBySlug($slug);

        if (! $doc || $doc['section'] === 'developer') {
            throw PageNotFoundException::forPageNotFound();
        }

        return view('docs/show', [
            'title'     => $doc['title'] . ' — Docs — BLUERABBIT',
            'activeNav' => 'docs',
            'doc'       => $doc,
            'backUrl'   => site_url('docs'),
        ]);
    }

    public function developer(): string
    {
        $model = new DocsPageModel();

        return view('docs/developer', [
            'title'     => 'Developer Docs — BLUERABBIT',
            'activeNav' => 'docs',
            'docs'      => $model->publishedBySection('developer'),
        ]);
    }

    public function developerShow(string $slug): string
    {
        $model = new DocsPageModel();
        $doc   = $model->findBySlug($slug);

        if (! $doc || $doc['section'] !== 'developer') {
            throw PageNotFoundException::forPageNotFound();
        }

        return view('docs/show', [
            'title'     => $doc['title'] . ' — Developer Docs — BLUERABBIT',
            'activeNav' => 'docs',
            'doc'       => $doc,
            'backUrl'   => site_url('docs/developer'),
        ]);
    }
}
