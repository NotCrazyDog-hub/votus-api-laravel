<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NewsControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_create_a_news_article(): void
    {
        $payload = [
            'titulo' => 'Nova notícia',
            'resumo_original' => 'Resumo original',
            'resumo_ia' => 'Resumo gerado por IA',
            'url' => 'https://example.com/noticia',
            'fonte' => 'Agência Brasil',
            'categoria' => 'Política',
            'data_publicacao' => '2026-07-18 10:00:00',
            'score_relevancia' => 8,
            'palavras_chave' => ['Brasil', 'Política'],
            'publicar' => true,
        ];

        $response = $this->postJson('/noticias', $payload);

        $response->assertStatus(201)
            ->assertJsonPath('message', 'Notícia criada');

        $this->assertDatabaseHas('noticias', [
            'url' => $payload['url'],
            'titulo' => $payload['titulo'],
        ]);
    }
}
