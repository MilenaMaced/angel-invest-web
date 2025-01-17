<?php

namespace Tests\Feature\Endereco;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateEnderecoTest extends EnderecoTest
{
    public function test_redenrizar_create_endereco()
    {
        $startup = $this->criar_startup();
        $this->logar($startup->user);

        $response = $this->get(route('enderecos.create', $startup));
        $response->assertStatus(200);
    }

    public function test_criar_endereco_para_uma_startup_existente()
    {
        $startup = $this->criar_startup();
        $this->logar($startup->user);

        $response = $this->post(route('enderecos.store', $startup), $this->get_array_endereco('76961-602', 'bairro teste', 'rua teste', '123','estado teste', 'cidade teste', 'complemento teste'));

        $response->assertStatus(302);

    }

    public function test_criar_endereco_para_uma_startup_nao_existente()
    {
        $startup = $this->criar_startup();
        $this->logar($startup->user);

        $response = $this->post(route('enderecos.store', $startup->id+1), $this->get_array_endereco('76961-602', 'bairro teste', 'rua teste', '123','estado teste', 'cidade teste', 'complemento teste'));

        $response->assertStatus(403);
    }

    public function test_criar_endereco_com_todos_os_campos_preenchidos()
    {
        $startup = $this->criar_startup();
        $this->logar($startup->user);

        $response = $this->post(route('enderecos.store', $startup), $this->get_array_endereco('76961-602', 'bairro teste', 'rua teste', '123','estado teste', 'cidade teste', 'complemento teste'));

        $response->assertStatus(302);

    }

    public function test_criar_endereco_com_campos_nulos_parcialmente()
    {
        $startup = $this->criar_startup();
        $this->logar($startup->user);

        $response = $this->post(route('enderecos.store', $startup), $this->get_array_endereco('76961-602', null, 'rua teste', null,'estado teste', 'cidade teste', 'complemento teste'));

        $response->assertStatus(302);
        $response->assertInvalid([
            'bairro' => 'O campo bairro é obrigatório.',
            'numero' => 'O campo numero é obrigatório.',

        ]);
    }

    public function test_criar_endereco_com_todos_os_campos_nulos()
    {
        $startup = $this->criar_startup();
        $this->logar($startup->user);

        $response = $this->post(route('enderecos.store',$startup), $this->get_array_endereco(null, null, null, null, null, null, null));

        $response->assertStatus(302);
        $response->assertInvalid([

            'bairro' => 'O campo bairro é obrigatório.',
            'rua' => 'O campo rua é obrigatório.',
            'numero' => 'O campo numero é obrigatório.',
            'estado' => 'O campo estado é obrigatório.',
            'cidade' => 'O campo cidade é obrigatório.',

        ]);
    }
}


