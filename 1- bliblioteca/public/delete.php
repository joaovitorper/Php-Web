<?php
require_once __DIR__ . '/../src/repositorio.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$id = $_POST['id'] ?? '';
$livros = ler_livros();

$novo = [];

foreach ($livros as $l) {
    if ($l['id'] !== $id) {
        $novo[] = $l;
    }
}

guardar_livros($novo);

header('Location: index.php');
exit;
