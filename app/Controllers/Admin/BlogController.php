<?php

namespace App\Controllers\Admin;

use App\Models\BlogPostModel;

class BlogController extends AdminBaseController
{
    public function index(): string
    {
        $model = new BlogPostModel();

        return view('admin/blog/index', $this->adminData('blog', [
            'title' => 'Manage Blog — BLUERABBIT Admin',
            'posts' => $model->orderBy('created_at', 'DESC')->findAll(),
        ]));
    }

    public function new(): string
    {
        return view('admin/blog/form', $this->adminData('blog', [
            'title' => 'New Post — BLUERABBIT Admin',
            'post'  => null,
            'errors'=> [],
        ]));
    }

    public function create()
    {
        $model = new BlogPostModel();
        $data  = $this->collectPostData();

        $imagePath = $this->handleImageUpload();
        if ($imagePath) {
            $data['featured_image'] = $imagePath;
        }

        if (! $model->validate($data)) {
            return view('admin/blog/form', $this->adminData('blog', [
                'title'  => 'New Post — BLUERABBIT Admin',
                'post'   => $data,
                'errors' => $model->errors(),
            ]));
        }

        $model->insert($data);

        return redirect()->to(site_url('admin/blog'))->with('admin_success', 'Post created.');
    }

    public function edit(int $id): string
    {
        $model = new BlogPostModel();
        $post  = $model->find($id);

        if (! $post) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('admin/blog/form', $this->adminData('blog', [
            'title'  => 'Edit Post — BLUERABBIT Admin',
            'post'   => $post,
            'errors' => [],
        ]));
    }

    public function update(int $id)
    {
        $model = new BlogPostModel();
        $post  = $model->find($id);

        if (! $post) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = $this->collectPostData($id);

        $imagePath = $this->handleImageUpload();
        if ($imagePath) {
            $data['featured_image'] = $imagePath;
        }

        if (! $model->validate($data)) {
            return view('admin/blog/form', $this->adminData('blog', [
                'title'  => 'Edit Post — BLUERABBIT Admin',
                'post'   => array_merge($post, $data, ['id' => $id]),
                'errors' => $model->errors(),
            ]));
        }

        $model->update($id, $data);

        return redirect()->to(site_url('admin/blog'))->with('admin_success', 'Post updated.');
    }

    public function delete(int $id)
    {
        $model = new BlogPostModel();
        $model->delete($id);

        return redirect()->to(site_url('admin/blog'))->with('admin_success', 'Post deleted.');
    }

    private function collectPostData(?int $id = null): array
    {
        $title = (string) $this->request->getPost('title');

        return [
            'title'           => $title,
            'slug'            => (string) ($this->request->getPost('slug') ?: url_title($title, '-', true)),
            'excerpt'         => (string) $this->request->getPost('excerpt'),
            'body'            => (string) $this->request->getPost('body'),
            'category'        => (string) $this->request->getPost('category'),
            'status'          => (string) $this->request->getPost('status'),
            'seo_title'       => (string) $this->request->getPost('seo_title'),
            'seo_description' => (string) $this->request->getPost('seo_description'),
            'published_at'    => $this->request->getPost('status') === 'published'
                ? ($this->request->getPost('published_at') ?: date('Y-m-d H:i:s'))
                : null,
        ] + ($id ? ['id' => $id] : []);
    }

    private function handleImageUpload(): ?string
    {
        $file = $this->request->getFile('featured_image');

        if (! $file || ! $file->isValid() || $file->hasMoved()) {
            return null;
        }

        $uploadPath = FCPATH . 'assets/uploads/blog';
        if (! is_dir($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }

        $newName = $file->getRandomName();
        $file->move($uploadPath, $newName);

        return 'assets/uploads/blog/' . $newName;
    }
}
