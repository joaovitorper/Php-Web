<?php
require_once __DIR__ . '/../src/repositorio.php';

$erro ="";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = trim($_POST['titulo'] ?? '');
    $autor  = trim($_POST['autor'] ?? '');
    $isbn   = trim($_POST['isbn'] ?? '');
    $ano    = trim($_POST['ano'] ?? '');

if ($titulo === '' || $autor === '' || $isbn === '' || $ano === '') {

    $erro = "Preencha todos os campos.";
} elseif (!is_numeric($ano)){
 $erro = "Ano inválido (usa apenas números).";
} else {
    $livros = ler_livros();

    $livros[] = [
        'id' => uniqid(),
        'titulo' => $titulo,
        'autor' => $autor,
        'isbn' => $isbn,
        'ano' => $ano
    ];
    guardar_livros($livros);

    header('location:index.php');
    exit;
};


}
 ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Novo livro</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">

    <header>
      <h1>+ Novo livro</h1>
      <a class="btn btn-primary" href="index.php">Voltar</a>
    </header>

    <?php if ($erro !== ""): ?>
  <div class="alert"><?php echo e($erro); ?></div>
<?php endif; ?>

<div class="card">
  <form method="POST">
    <label>Título</label>
    <input type="text" name="titulo" placeholder="Ex.: Dom Casmurro">

    <label>Autor</label>
    <input type="text" name="autor" placeholder="Ex.: Machado de Assis">

    <label>ISBN</label>
    <input type="text" name="isbn" placeholder="Ex.: 978-85-0000-000-0">
    <div class="helper">Pode ser ISBN completo ou apenas números.</div>

    <label>Ano</label>
    <input type="text" name="ano" placeholder="Ex.: 1899">

    <br><br>
    <button class="btn btn-primary" type="submit">Guardar livro</button>
  </form>
</div>

  </div>
</body>
</html>
