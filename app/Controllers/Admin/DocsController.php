<?php

namespace App\Controllers\Admin;

use App\Models\DocsPageModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class DocsController extends AdminBaseController
{
    public function index(): string
    {
        $model = new DocsPageModel();

        return view('admin/docs/index', $this->adminData('docs', [
            'title' => 'Manage Docs — BLUERABBIT Admin',
            'docs'  => $model->orderBy('section', 'ASC')->orderBy('sort_order', 'ASC')->findAll(),
        ]));
    }

    public function new(): string
    {
        return view('admin/docs/form', $this->adminData('docs', [
            'title'  => 'New Doc Page — BLUERABBIT Admin',
            'doc'    => null,
            'errors' => [],
        ]));
    }

    public function create()
    {
        $model = new DocsPageModel();
        $data  = $this->collectData();

        if (! $model->validate($data)) {
            return view('admin/docs/form', $this->adminData('docs', [
                'title'  => 'New Doc Page — BLUERABBIT Admin',
                'doc'    => $data,
                'errors' => $model->errors(),
            ]));
        }

        $model->insert($data);

        return redirect()->to(site_url('admin/docs'))->with('admin_success', 'Doc page created.');
    }

    public function edit(int $id): string
    {
        $model = new DocsPageModel();
        $doc   = $model->find($id);

        if (! $doc) {
            throw PageNotFoundException::forPageNotFound();
        }

        return view('admin/docs/form', $this->adminData('docs', [
            'title'  => 'Edit Doc Page — BLUERABBIT Admin',
            'doc'    => $doc,
            'errors' => [],
        ]));
    }

    public function update(int $id)
    {
        $model = new DocsPageModel();
        $doc   = $model->find($id);

        if (! $doc) {
            throw PageNotFoundException::forPageNotFound();
        }

        $data = $this->collectData($id);

        if (! $model->validate($data)) {
            return view('admin/docs/form', $this->adminData('docs', [
                'title'  => 'Edit Doc Page — BLUERABBIT Admin',
                'doc'    => array_merge($doc, $data, ['id' => $id]),
                'errors' => $model->errors(),
            ]));
        }

        $model->update($id, $data);

        return redirect()->to(site_url('admin/docs'))->with('admin_success', 'Doc page updated.');
    }

    public function delete(int $id)
    {
        (new DocsPageModel())->delete($id);

        return redirect()->to(site_url('admin/docs'))->with('admin_success', 'Doc page deleted.');
    }

    private function collectData(?int $id = null): array
    {
        $title = (string) $this->request->getPost('title');

        return [
            'title'      => $title,
            'slug'       => (string) ($this->request->getPost('slug') ?: url_title($title, '-', true)),
            'section'    => (string) $this->request->getPost('section'),
            'body'       => (string) $this->request->getPost('body'),
            'status'     => (string) $this->request->getPost('status'),
            'sort_order' => (int) $this->request->getPost('sort_order'),
        ] + ($id ? ['id' => $id] : []);
    }
}
