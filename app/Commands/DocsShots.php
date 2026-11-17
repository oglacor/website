<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

/**
 * Turns app screenshots into the docs' figures: public/assets/docs/<set>/<name>.webp.
 * Landscape shots are scaled to 1600px wide, portrait (phone) shots to 720px; WebP quality 80.
 */
class DocsShots extends BaseCommand
{
    protected $group       = 'Docs';
    protected $name        = 'docs:shots';
    protected $description = 'Convert screenshots (JPEG/PNG) into WebP figures under public/assets/docs/<set>/.';
    protected $usage       = 'docs:shots <source folder> <set> [file.jpg ...]';
    protected $arguments   = [
        'source folder' => 'Folder holding the screenshots.',
        'set'           => 'Folder name under public/assets/docs (lowercase, hyphens).',
        'file.jpg'      => 'Files to convert; all JPEG/PNG files in the folder when none are given.',
    ];

    public function run(array $params)
    {
        [$src, $set] = [rtrim($params[0] ?? '', '/\\'), $params[1] ?? ''];
        if (! is_dir($src) || ! preg_match('/^[a-z0-9-]+$/', $set)) {
            CLI::error('Usage: php spark ' . $this->usage);

            return EXIT_ERROR;
        }

        $files = array_slice($params, 2) ?: array_map('basename', glob($src . '/*.{jpg,jpeg,png}', GLOB_BRACE));
        $dest  = FCPATH . 'assets/docs/' . $set;
        if (! is_dir($dest)) {
            mkdir($dest, 0755, true);
        }

        foreach ($files as $file) {
            $in   = $src . '/' . $file;
            $info = is_file($in) ? getimagesize($in) : false;
            $img  = match ($info[2] ?? null) {
                IMAGETYPE_JPEG => imagecreatefromjpeg($in),
                IMAGETYPE_PNG  => imagecreatefrompng($in),
                default        => false,
            };
            if (! $img) {
                CLI::error("Skipped $file: not a readable JPEG or PNG");

                continue;
            }

            [$w, $h] = [$info[0], $info[1]];
            $max     = $h > $w ? 720 : 1600;
            if ($w > $max) {
                $h      = (int) round($h * $max / $w);
                $scaled = imagescale($img, $max, $h, IMG_BICUBIC);
                imagedestroy($img);
                [$img, $w] = [$scaled, $max];
            }

            $out = $dest . '/' . pathinfo($file, PATHINFO_FILENAME) . '.webp';
            imagewebp($img, $out, 80);
            imagedestroy($img);
            CLI::write(sprintf('/assets/docs/%s/%s  %dx%d  %dKB', $set, basename($out), $w, $h, filesize($out) / 1024));
        }

        return EXIT_SUCCESS;
    }
}
