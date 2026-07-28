<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * Site's own session-based auth filter — separate from the main BLUERABBIT
 * app's auth entirely (own users table, own session). Usage: 'auth' requires
 * any logged-in user; 'auth:admin' additionally requires the admin role.
 */
class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        if (! $session->get('user_id')) {
            $session->setFlashdata('auth_error', 'Please log in to continue.');

            return redirect()->to(site_url('login'))->withCookies();
        }

        if (in_array('admin', $arguments ?? [], true) && $session->get('user_role') !== 'admin') {
            return service('response')->setStatusCode(403)
                ->setBody('403 — Admins only.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No post-processing needed.
    }
}
