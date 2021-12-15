<?php

session_start();
include_once('cadastrese.php');
include_once('conecao.php');


$selecionaGrupo = filter_input(INPUT_POST, 'selecionaGrupo', FILTER_SANITIZE_NUMBER_INT);

$gravaGrupo = "INSERT INTO usuario (id_grupo) VALUES ('$selecionaGrupo')";
$resultGravacao = mysqli_query($conn, $gravaGrupo);

if (mysqli_affected_rows($conn) != 0) {
    echo "
          <META HTTP-EQUIV=REFRESH CONTENT = 'O;URL=cadastrese.php'>
          <script type=\"text/javascript\">
            alert(\"Produto Cadastrado com Sucesso.\");
          </script>
      ";
  } else {
    echo "
          <META HTTP-EQUIV=REFRESH CONTENT = 'O;URL=cadastrese.php'>
          <script type=\"text/javascript\">
            alert(\"Problema ao cadastrar o produto, tente novamente.\");
          </script>
      ";
  }


?>