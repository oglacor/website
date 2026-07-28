<?php

namespace App\Models;

use CodeIgniter\Model;

class SiteSettingModel extends Model
{
    protected $table            = 'site_settings';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['setting_key', 'value'];
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';

    public function getSetting(string $key, ?string $default = null): ?string
    {
        $row = $this->where('setting_key', $key)->first();

        return $row['value'] ?? $default;
    }

    public function setSetting(string $key, ?string $value): void
    {
        $existing = $this->where('setting_key', $key)->first();

        if ($existing) {
            $this->update($existing['id'], ['value' => $value]);
        } else {
            $this->insert(['setting_key' => $key, 'value' => $value]);
        }
    }
}
