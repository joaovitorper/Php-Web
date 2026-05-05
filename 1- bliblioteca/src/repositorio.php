<?php

function caminho_json(): string
{
    return __DIR__ . '/../data/livros.json';
}

function ler_livros(): array
{
    $ficheiro = caminho_json();

    if (!file_exists($ficheiro)) {
        return [];
    }

    $conteudo = file_get_contents($ficheiro);
    $dados = json_decode($conteudo, true);

    return is_array($dados) ? $dados : [];
}

function guardar_livros(array $livros): void
{
    $ficheiro = caminho_json();

    file_put_contents(
        $ficheiro,
        json_encode($livros, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
    );
}

function e(string $texto): string
{
 return htmlspecialchars($texto, ENT_QUOTES, 'UTF-8');
}