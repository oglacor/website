<?php

namespace App\Controllers;

use App\Models\DocsPageModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Docs extends BaseController
{
    public function index(): string
    {
        $model   = new DocsPageModel();
        $setup   = $model->publishedBySection('setup');

        // Enterprise-tagged pages get their own section on the hub rather than
        // being buried in the same grid as day-to-day GM topics — a title-suffix
        // convention rather than a schema change, since it's purely a display split.
        $enterprise = array_values(array_filter($setup, static fn ($doc) => str_ends_with($doc['title'], '(Enterprise)')));
        $setupDocs  = array_values(array_filter($setup, static fn ($doc) => ! str_ends_with($doc['title'], '(Enterprise)')));

        return view('docs/index', [
            'title'         => 'Documentation — BLUERABBIT',
            'activeNav'     => 'docs',
            'userDocs'      => $model->publishedBySection('user'),
            'setupDocs'     => $setupDocs,
            'enterpriseDocs'=> $enterprise,
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
