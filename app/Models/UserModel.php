<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['name', 'email', 'password_hash', 'role', 'status'];
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';

    protected $validationRules = [
        'id'    => 'permit_empty|is_natural',
        'name'  => 'required|min_length[2]|max_length[150]',
        'email' => 'required|valid_email|max_length[255]|is_unique[users.email,id,{id}]',
    ];
    protected $validationMessages = [
        'email' => [
            'is_unique' => 'An account with that email already exists.',
        ],
    ];

    public function findByEmail(string $email)
    {
        return $this->where('email', $email)->first();
    }

    public function registerUser(string $name, string $email, string $password, string $role = 'user'): int|false
    {
        if (! $this->validate(['name' => $name, 'email' => $email])) {
            return false;
        }

        return $this->insert([
            'name'          => $name,
            'email'         => $email,
            'password_hash' => password_hash($password, PASSWORD_DEFAULT),
            'role'          => $role,
            'status'        => 'active',
        ]);
    }
}
