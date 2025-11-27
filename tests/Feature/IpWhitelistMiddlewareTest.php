<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;
use App\Models\AdminAllowedIp;

class IpWhitelistMiddlewareTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Register a temporary route that uses the admin.ip middleware alias
        Route::middleware('admin.ip')->get('/test-ip-whitelist', function () {
            return response('ok');
        });
    }

    /** @test */
    public function allowed_ip_passes_through(): void
    {
        config(['admin.security.ip_whitelist_enabled' => true]);

        // Add DB row allowing the local IP
        AdminAllowedIp::create([
            'ip_address' => '127.0.0.1',
            'label' => 'local',
            'is_active' => true,
        ]);

        $this->get('/test-ip-whitelist')
             ->assertStatus(200)
             ->assertSee('ok');
    }

    /** @test */
    public function unknown_ip_returns_403_by_default(): void
    {
        config(['admin.security.ip_whitelist_enabled' => true]);
        config(['admin.security.ip_whitelist_reject_status' => 403]);

        // Simulate request from remote IP that's not allowed
        $this->withServerVariables(['REMOTE_ADDR' => '1.2.3.4'])
             ->get('/test-ip-whitelist')
             ->assertStatus(403);
    }

    /** @test */
    public function unknown_ip_returns_404_when_configured_to_hide(): void
    {
        config(['admin.security.ip_whitelist_enabled' => true]);
        config(['admin.security.ip_whitelist_reject_status' => 404]);

        // Simulate request from remote IP that's not allowed
        $this->withServerVariables(['REMOTE_ADDR' => '1.2.3.4'])
             ->get('/test-ip-whitelist')
             ->assertStatus(404);
    }
}
