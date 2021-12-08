<?php

include_once('cadastrese.php');
include_once('conecao.php');

$selecionaGrupo = $_POST['selecionaGrupo'];

$gravaGrupo = "INSERT INTO usuario_grupo (id_grupo_de_usuario) VALUES ('$slecionaGrupo')";
$resultGravacao = mysqli_query($mysqli, $gravaGrupo);

if (mysqli_affected_rows($mysqli) != 0) {
    echo "
          <META HTTP-EQUIV=REFRESH CONTENT = 'O;URL=produtos.php'>
          <script type=\"text/javascript\">
            alert(\"Produto Cadastrado com Sucesso.\");
          </script>
      ";
  } else {
    echo "
          <META HTTP-EQUIV=REFRESH CONTENT = 'O;URL=produtos.php'>
          <script type=\"text/javascript\">
            alert(\"Problema ao cadastrar o produto, tente novamente.\");
          </script>
      ";
  }


?>