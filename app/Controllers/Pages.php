<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function product(): string
    {
        return view('pages/placeholder', [
            'title'     => 'Product — BLUERABBIT',
            'activeNav' => 'product',
            'eyebrow'   => 'Product',
            'heading'   => 'The full platform overview lands next.',
            'body'      => 'Journey map, XP/BLOO/EP, achievements, guilds, and the full step library — this page walks through every mechanic in detail.',
        ]);
    }

    public function solutions(): string
    {
        return view('pages/placeholder', [
            'title'     => 'Solutions — BLUERABBIT',
            'activeNav' => 'solutions',
            'eyebrow'   => 'Solutions',
            'heading'   => 'Built for L&D, onboarding, and bootcamps.',
            'body'      => 'Use-case breakdowns for corporate learning teams, employee onboarding programs, and cohort-based bootcamps are coming to this page.',
        ]);
    }

    public function pricing(): string
    {
        return view('pages/placeholder', [
            'title'     => 'Pricing — BLUERABBIT',
            'activeNav' => 'pricing',
            'eyebrow'   => 'Pricing',
            'heading'   => 'Plans, mirrored from the live Stripe config.',
            'body'      => "Once the open CI4 core's Stripe plans are finalized, this page will pull them in directly so pricing never drifts out of sync.",
        ]);
    }

    public function contact(): string
    {
        return view('pages/placeholder', [
            'title'     => 'Contact — BLUERABBIT',
            'activeNav' => 'contact',
            'eyebrow'   => 'Contact',
            'heading'   => "Let's talk.",
            'body'      => 'A real contact form is next on the list — for now, reach out directly and we\'ll get back to you.',
        ]);
    }

    public function login(): string
    {
        return view('pages/placeholder', [
            'title'     => 'Log In — BLUERABBIT',
            'activeNav' => 'login',
            'eyebrow'   => 'Account',
            'heading'   => 'Login is being wired up next.',
            'body'      => 'Auth for admins, collaborators, and open-beta users lands in the next build phase.',
        ]);
    }

    public function getStarted(): string
    {
        return view('pages/placeholder', [
            'title'     => 'Get Started — BLUERABBIT',
            'activeNav' => 'get-started',
            'eyebrow'   => 'Open Beta',
            'heading'   => 'Signup for the open CI4 core is coming soon.',
            'body'      => 'Join the waitlist on the homepage in the meantime — you\'ll be first in line when signup opens.',
        ]);
    }

    public function docs(): string
    {
        return view('pages/docs', [
            'title'     => 'Documentation — BLUERABBIT',
            'activeNav' => 'docs',
        ]);
    }
}
