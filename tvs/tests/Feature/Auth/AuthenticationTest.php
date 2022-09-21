<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;
    //verifica se o usuario esta logado
    public function test_tela_login()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }
    //testa se informações estão corretas e redirecionando para a home
    public function test_info_usuario()
    {
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);
    }
    //testa o usuario logando com a senha incorreta
    public function test_info_usuario_senha_invalida()
    {
        $user = User::factory()->create();

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
    }
}
