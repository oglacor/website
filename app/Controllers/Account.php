<?php

namespace App\Controllers;

use App\Models\UserModel;

class Account extends BaseController
{
    public function index(): string
    {
        $model = new UserModel();
        $user  = $model->find(session()->get('user_id'));

        return view('account/index', [
            'title'     => 'My Account — BLUERABBIT',
            'activeNav' => 'account',
            'user'      => $user,
        ]);
    }
}
