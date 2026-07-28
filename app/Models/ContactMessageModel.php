<?php

namespace App\Models;

use CodeIgniter\Model;

class ContactMessageModel extends Model
{
    protected $table            = 'contact_messages';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['name', 'email', 'subject', 'message', 'status'];
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = '';

    protected $validationRules = [
        'name'    => 'required|min_length[2]|max_length[150]',
        'email'   => 'required|valid_email',
        'message' => 'required|min_length[10]',
    ];
}
