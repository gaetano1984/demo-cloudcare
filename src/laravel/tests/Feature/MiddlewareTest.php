<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MiddlewareTest extends TestCase
{
    /**
     * Testo il caso di un login fallito
     */
    public function test_login_failed(){
        $this->post('api/auth', ['email' => 'root', 'password' => 'root'])->assertStatus(404);
    }

    /**
     * Testo il caso un login ok 
     * Testo che nella risposta ci sia una chiave token
     */
    public function test_login_ok(){
        $response = $this->post('api/auth', ['email' => 'root', 'password' => 'password'])
            ->assertStatus(200)
            ->assertJsonStructure([
                'token'
            ])
        ;
    }

    /**
     * Per accedere alla ricerca delle birre è necessario includere un header Token con un token valido 
     *
     * @return void
     */
    public function test_token_required(){
        $this->get('api/beer/search')->assertStatus(500);
    }

    /**
     * Testo il caso di una ricerca funzionante con token valido
     */
    public function test_search_ok(){
        $response = $this->post('api/auth', ['email' => 'root', 'password' => 'password']);
        $data = $response->getData();

        $this->withHeaders([
            'token' => $data->token
        ])->get('api/beer/search')
        ->assertSTatus(200)
        ->assertJsonStructure([
            'beer'
        ]);
    }

    public function test_search_per_page_error(){
        $response = $this->post('api/auth', ['email' => 'root', 'password' => 'password']);
        $data = $response->getData();
        $resp = $this->withHeaders([
            'token' => $data->token
        ])->get('api/beer/search?per_page=pippo')
        ->assertJsonStructure([
            'res'
            ,'errors' => [
                'per_page'
            ]
        ]);
    }

    public function test_search_page_error(){
        $response = $this->post('api/auth', ['email' => 'root', 'password' => 'password']);
        $data = $response->getData();
        $resp = $this->withHeaders([
            'token' => $data->token
        ])->get('api/beer/search?page=pippo')
        ->assertJsonStructure([
            'res'
            ,'errors' => [
                'page'
            ]
        ]);
    }

    public function test_search_per_page_ok(){
        $response = $this->post('api/auth', ['email' => 'root', 'password' => 'password']);
        $data = $response->getData();
        $resp = $this->withHeaders([
            'token' => $data->token
        ])->get('api/beer/search?per_page=1')
        ->assertJsonStructure([
            'beer'
        ]);
    }

    public function test_search_page_ok(){
        $response = $this->post('api/auth', ['email' => 'root', 'password' => 'password']);
        $data = $response->getData();
        $resp = $this->withHeaders([
            'token' => $data->token
        ])->get('api/beer/search?page=1')
        ->assertJsonStructure([
            'beer'
        ]);
    }
}
