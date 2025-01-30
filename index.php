<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do livro</title>
    <link rel="stylesheet" href="styles/phpStyle.css">
</head>
<body>
  <div class="container">
      <h1 class="title">Detalhes do livro</h1>
      <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
          // usando o date() com Y para pegar apenas o Year (ano)
          $ano = intval(date("Y"));

          // requisitando os valores dos inputs
          $tituloLivro = htmlspecialchars(trim($_POST["tituloLivro"]));
          $autor = htmlspecialchars(trim($_POST["autor"]));
          $anoPublicacao = intval($_POST["anoPublicacao"]);
          $paginas = intval($_POST["paginas"]);
          $quantidade = intval($_POST["quantidade"]);
      ?>

      <!-- mostrando dados na tela com css -->
      <div class="title">
        <?php

          // validando campos com operador ternário (acho mais limpo o código)
          $printTitle = ($tituloLivro == "") ? "<p style='color: red;'>OOPS! Campo Vazio!</p>" : "<p>Nome do Livro: <b>$tituloLivro</b></p>";
          echo $printTitle;

          $printAutor = ($autor == "") ? "<p style='color: red;'>OOPS! Campo Vazio! </p>" : "<p>Autor: <b>$autor</b></p>";
          echo $printAutor;
          
          // usando if e else para fazer a validação das datas
          if ($anoPublicacao <= 1800) {
            echo "<p style='color: red;'>Livro muito antigo!</p>";
          } elseif ($anoPublicacao > $ano) {
            echo "<p style='color: red;'>Esse livro veio do futuro?!</p>";
          } else {
            echo "<p>Ano de Publicação: <b>$anoPublicacao</b></p>";
          }

          $printPaginas = ($paginas <= 0) ? "<p style='color: red;'>Numero de páginas inválido!</p>" : "<p>Paginas: <b>$paginas</b></p>";
          echo $printPaginas;

          $printQuantidade = ($quantidade < 0) ? "<p style='color: red;'>Quantidade no acervo inválida! </p>" : "<p>Quantidade no Acervo: <b>$quantidade</b></p>";
          echo $printQuantidade;

          // calculo do tempo de publicação
          $tempoPublicacao = $ano - $anoPublicacao;
          echo "<p>Este livro foi publicado há: <b>$tempoPublicacao</b> anos</p>";

          // calculo do valor estimado do acervo
          $valorEstimadoAcervo = $paginas * 0.50 * $quantidade;
          echo "<p>Valor estimado do livro: R$<b>" . number_format($valorEstimadoAcervo, 2, ',', '.') . "</b></p>";

        ?>
      </div>

      <!-- tratamento de erro -->
      <div class="error">
        <?php
        // fazendo tratamento de erro
          } else {
              echo "<p>OOPS! Nada enviado!</p>";
          }
        ?>
      </div>
    </div>
</body>
</html>
