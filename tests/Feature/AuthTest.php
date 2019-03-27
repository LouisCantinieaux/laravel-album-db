<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();

        $user = new User([
          'email' => 'test@email.com',
          'password' => '123456'
        ]);

        $user->save();
    }

    /** @test **/
    public function register_user()
    {
      $response = $this->post('api/register', [
        'email' => 'test2@email.com',
        'password' => '123456'
      ]);

      $response->assertJsonStructure([
        'access_token',
        'token_type',
        'expires_in'
      ]);
    }

    public function not_log_invalid_user()
    {
      $response = $this->post('api/login', [
        'email' => 'test@email.com',
        'password' => 'notlegitpassword'
      ]);

      $response->assertJsonStructure([
        'error',
      ]);
    }
}
