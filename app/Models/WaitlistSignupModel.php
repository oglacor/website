<?php

namespace App\Models;

use CodeIgniter\Model;

class WaitlistSignupModel extends Model
{
    protected $table            = 'waitlist_signups';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['email', 'source', 'status', 'notified_at'];
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = '';

    protected $validationRules = [
        'email' => 'required|valid_email|is_unique[waitlist_signups.email]',
    ];
    protected $validationMessages = [
        'email' => [
            'is_unique' => "You're already on the list — we'll be in touch.",
        ],
    ];
}
