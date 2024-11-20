<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GetStatusUrlTest extends TestCase
{
    public function test_get_status_url()
    {
        // Dados de entrada
        $url = 'http://google.com.br';

        // Realiza a requisição GET para a rota, passando a URL como um parâmetro na query string
        $response = $this->get('/getStatusUrl?url=' . urlencode($url));

        // Verifica se o status da resposta é 200 OK
        $response->assertStatus(200);

        // Verifica se a resposta contém os dados esperados
        $response->assertJsonStructure([
            'status',
            'detalhes',
        ]);
    }
}
