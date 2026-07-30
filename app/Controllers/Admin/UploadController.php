<?php

namespace App\Controllers\Admin;

/**
 * Backs the TinyMCE image-upload button used in both the blog and docs
 * admin editors — shared since it's the same trust boundary (admin-only)
 * and the same storage convention.
 */
class UploadController extends AdminBaseController
{
    public function image()
    {
        $file = $this->request->getFile('file');

        if (! $file || ! $file->isValid() || $file->hasMoved()) {
            return $this->response->setStatusCode(400)->setJSON(['error' => 'Upload failed.']);
        }

        if (! str_starts_with((string) $file->getClientMimeType(), 'image/')) {
            return $this->response->setStatusCode(400)->setJSON(['error' => 'Only image files are allowed.']);
        }

        $uploadPath = FCPATH . 'assets/uploads/content';
        if (! is_dir($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }

        $newName = $file->getRandomName();
        $file->move($uploadPath, $newName);

        return $this->response->setJSON(['location' => base_url('assets/uploads/content/' . $newName)]);
    }
}
