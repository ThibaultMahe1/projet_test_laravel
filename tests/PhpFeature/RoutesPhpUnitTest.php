<?php

namespace Tests\PhpFeature;

use Tests\TestCase;

class RoutesPhpUnitTest extends TestCase
{
    public function test_dashboard_redirects_to_login_when_unauthenticated()
    {
        $response = $this->get('/dashboard');

        // Unauthenticated users should be redirected to login
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    public function test_profile_redirects_to_login_when_unauthenticated()
    {
        $response = $this->get('/profile');

        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    public function test_lang_route_redirects_back_to_referer()
    {
        // Provide a Referer header so redirect()->back() has a target
        $response = $this->get('/lang/en', ['HTTP_REFERER' => '/previous-page']);

        $response->assertStatus(302);
        $response->assertRedirect('/previous-page');
    }
}
