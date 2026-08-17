<?php

namespace App\Controllers\Admin;

/**
 * Backs the TinyMCE image-upload button used in both the blog and docs
 * admin editors — shared since it's the same trust boundary (admin-only)
 * and the same storage convention.
 *
 * SECURITY — why this is written the way it is (2026-08-17).
 *
 * The original version checked `getClientMimeType()` and then saved under
 * `getRandomName()`. That was a remote code execution hole:
 *
 *   1. `getClientMimeType()` is the browser-supplied Content-Type header.
 *      An attacker sets it to `image/png` and the check passes regardless
 *      of what the file actually is.
 *   2. `getRandomName()` derives its extension from `guessExtension()`,
 *      which uses the REAL finfo-detected type. PHP source detects as
 *      `text/x-php`, which is in CI4's own `mimes['php']` list, so the
 *      proposed `.php` extension was preserved.
 *   3. The file landed in `public/assets/uploads/content/`, which Apache
 *      serves and will happily execute.
 *
 * So: never trust the client's mime, and never let the uploaded filename
 * decide the stored extension. Both are fixed below, and the extension is
 * chosen from our own whitelist rather than from anything in the request.
 * `public/assets/uploads/.htaccess` blocks execution as a second layer, so
 * a bypass here still doesn't run code.
 */
class UploadController extends AdminBaseController
{
    /**
     * Real (finfo-detected) mime type => the extension we will store it as.
     * The stored extension always comes from this map, never from the upload.
     *
     * SVG is deliberately absent: an .svg is XML that can carry <script>, so
     * serving user-supplied SVG from our own origin is stored XSS. Add it only
     * alongside sanitising, or serve it from a separate origin.
     */
    private const ALLOWED = [
        'image/jpeg' => 'jpg',
        'image/pjpeg' => 'jpg',
        'image/png'  => 'png',
        'image/gif'  => 'gif',
        'image/webp' => 'webp',
    ];

    private const MAX_BYTES = 5 * 1024 * 1024;

    public function image()
    {
        $file = $this->request->getFile('file');

        if (! $file || ! $file->isValid() || $file->hasMoved()) {
            return $this->response->setStatusCode(400)->setJSON(['error' => 'Upload failed.']);
        }

        if ($file->getSize() > self::MAX_BYTES) {
            return $this->response->setStatusCode(400)->setJSON(['error' => 'Images must be 5MB or smaller.']);
        }

        // finfo-based, reads the actual file bytes — not the client's header.
        $mime = strtolower((string) $file->getMimeType());

        if (! isset(self::ALLOWED[$mime])) {
            return $this->response->setStatusCode(400)->setJSON(['error' => 'Only JPG, PNG, GIF and WebP images are allowed.']);
        }

        // Belt and braces: a file can begin with valid image bytes and still
        // carry PHP further in. getimagesize() confirms it parses as a real
        // image of the type we think it is.
        $info = @getimagesize($file->getTempName());

        if ($info === false || ! isset($info[2]) || ! in_array($info[2], [IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_GIF, IMAGETYPE_WEBP], true)) {
            return $this->response->setStatusCode(400)->setJSON(['error' => 'That file is not a readable image.']);
        }

        $uploadPath = FCPATH . 'assets/uploads/content';

        if (! is_dir($uploadPath) && ! mkdir($uploadPath, 0755, true) && ! is_dir($uploadPath)) {
            return $this->response->setStatusCode(500)->setJSON(['error' => 'Upload directory is not writable.']);
        }

        // Name is built entirely by us. Nothing from the request reaches it.
        $newName = bin2hex(random_bytes(16)) . '.' . self::ALLOWED[$mime];

        $file->move($uploadPath, $newName);

        return $this->response->setJSON(['location' => base_url('assets/uploads/content/' . $newName)]);
    }
}
