<?php
include_once('conecao.php');
include_once('../classes/chamados.php');
include('../classes/usuarios.php');

session_start();
if (!isset($_SESSION['id_usuario'])) {
    header("location: ../index.php");
    exit;
}


$nameResult = "SELECT * from usuario WHERE '$_SESSION[id_usuario]' = id_usuario";
$resultado_nome = mysqli_query($conn, $nameResult);
$LNome = mysqli_fetch_assoc($resultado_nome);
?>

<!DOCTYPE html>
<html lang="pt/br">

<head>  
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario</title>
</head>

<body>
    <div class="container">
        <form method="POST">
        <div class="box">
            <p>Formulario de pedidos</p>
            <label for="text">Colaborador</label>
            <input type="text" placeholder="Digite o seu nome" name="nome" id="nome" value="<?php echo $LNome['nome']; ?>" />
        </div>
        <br>
        <div class="box">
            <label for="">descricao</label>
            <textarea name="descricao" id="" cols="30" rows="10"></textarea>
        </div>
        <br>
        <div class="box">
            <select name="ativo">
                <option></option>
                <?php
                $resultadoAtivo = "SELECT * FROM ativo";
                $re_ativo = mysqli_query($conn, $resultadoAtivo);
                while ($row_ativo = mysqli_fetch_assoc($re_ativo)) { ?>
                    <option value="<?php echo $row_ativo['id_ativo'] ?>">
                        <?php echo $row_ativo['descricao']; ?>
                    </option> <?php
                            }
                                ?>
            </select>
            <br>
            <select name="tipo">
                <option></option>
                <?php
                $resultadoTipo = "SELECT * FROM tipo";
                $re_ativo = mysqli_query($conn, $resultadoTipo);
                while ($row_ativo = mysqli_fetch_assoc($re_ativo)) { ?>
                    <option value="<?php echo $row_ativo['id_tipo'] ?>">
                        <?php echo $row_ativo['descricao']; ?>
                    </option> <?php
                            }
                                ?>
            </select>

            <input type="submit">
            </form>
        </div>
        <br>
      
</body>

</html>

<?php
$c = new Chamado;

//vereficar se clicou no nome
if (isset($_POST['nome'])) {
    $descricao = addslashes($_POST['descricao']);
    $id_ativo = addslashes($_POST['ativo']);
    $id_usuario = addslashes($_POST['nome']);

    $id_usuario = $_SESSION['id_usuario'];



    if (!empty($descricao) && !empty($id_ativo) && !empty($id_usuario)) {

        if ($c->msgErro == "") {

            if ($c->cadastrar_chamados($descricao, $id_ativo, $id_usuario)) {
                echo "<script>alert('Chamado enviado com sucesso!!')</script>";
            } else {
                echo "<script>alert('Chamado já realizado!');</script>";
            }
        } else {
            echo "Erro: " . $c->msgErro;
        }
    } else {
        echo "<script>alert('Preencha todos os campos!');</script>";
    }       
}
?>