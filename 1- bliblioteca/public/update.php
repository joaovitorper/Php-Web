<?php
require_once __DIR__ . '/../src/repositorio.php';

$id = $_GET['id'] ?? '';

$livros = ler_livros(); 
$livro = null;
$posicao = null;

foreach ($livros as $i => $l) {
    if ($l['id'] == $id) {
        $livro = $l;
        $posicao = $i;
        break;
    }
}

if (!$livro) {
    echo "Livro não encontrado.";
    exit;
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $titulo = $_POST ['titulo']?? '';
    $autor = $_POST ['autor']?? '';
    $isbn = $_POST ['isbn']?? '';
    $ano = $_POST ['ano']?? '';

  if ($titulo === '' || $autor === '' || $isbn === '' || $ano === '') {
    echo "Preencha todos os campos.";
  exit;

}
$livros[$posicao]['titulo'] = $titulo;
$livros[$posicao]['autor']  = $autor;
$livros[$posicao]['isbn']   = $isbn;
$livros[$posicao]['ano']    = $ano;

guardar_livros($livros);

header('Location: index.php');
exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Editar livro</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
  <header>
    <h1>Editar livro</h1>
    <a class="btn btn-primary" href="index.php">Voltar</a>
  </header>

  <div class="card">
    <form method="POST">
      <label>Título</label>
      <input type="text" name="titulo" value="<?php echo e($livro['titulo']); ?>">

      <label>Autor</label>
      <input type="text" name="autor" value="<?php echo e($livro['autor']); ?>">

      <label>ISBN</label>
      <input type="text" name="isbn" value="<?php echo e($livro['isbn']); ?>">

      <label>Ano</label>
      <input type="text" name="ano" value="<?php echo e($livro['ano']); ?>">

      <br><br>
      <button class="btn btn-primary" type="submit">Salvar alterações</button>
    </form>
  </div>
</div>

</body>
</html>