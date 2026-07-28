<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

abstract class AdminBaseController extends BaseController
{
    protected function adminData(string $activeAdminNav, array $extra = []): array
    {
        return array_merge([
            'activeAdminNav' => $activeAdminNav,
            'adminUserName'  => session()->get('user_name'),
        ], $extra);
    }
}
