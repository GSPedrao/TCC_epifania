<?php
include_once('conecao.php');
include_once('../classes/ativos.php');
include_once('../classes/usuarios.php');

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
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
</head>

<body>
    <div id="#">
        <!--formulario para cadastro de ativo-->
        <form method="POST">
            <div class="input-group mb-4" id="#">
                <h1></h1>
                <p>Colaborador</p>
                <input type="text" id="#" class="form-control" name="nome" value="<?php echo $LNome['nome']; ?>">
                <br>
                <p>Tipo</p>
                <select name="tipo">
                    <option></option>
                    <?php
                    $resultadoAtivo = "SELECT * FROM tipo";
                    $re_ativo = mysqli_query($conn, $resultadoAtivo);
                    while ($row_ativo = mysqli_fetch_assoc($re_ativo)) { ?>
                        <option value="<?php echo $row_ativo['id_tipo'] ?>">
                            <?php echo $row_ativo['descricao']; ?>
                        </option> <?php
                                }
                                    ?>
                </select>
                <br>
                <div>
                    <label>localização</label>
                    <br>
                    <select name="localizacao">
                        <option></option>
                        <?php
                        $resultadoLoc = "SELECT * FROM localizacao";
                        $re_loc = mysqli_query($conn, $resultadoLoc);
                        while ($row_loc = mysqli_fetch_assoc($re_loc)) { ?>
                            <option value="<?php echo $row_loc['id_localizacao'] ?>">
                                <?php echo $row_loc['descricao']; ?>
                            </option> <?php
                                    }
                                        ?>
                    </select>
                </div>
                <p>Patrimonio</p>
                <input type="number" id="#" class="form-control" name="patrimonio">
                <br>
                <p>Descrição</p>
                <textarea name="descricao"> </textarea>

            </div>
            <input type="submit" value="Salvar"> <!--botão para cadastro do ativo-->
        </form>
    </div>
</body>

</html>

<?php
$a = new Ativos;

//vereficar se clicou no nome
if (isset($_POST['nome'])) {
    $descricao = addslashes($_POST['descricao']);
    $id_tipo = addslashes($_POST['tipo']);
    $id_usuario = addslashes($_POST['nome']);
    $id_localizacao = addslashes($_POST['localizacao']);
    $patrimonio = addslashes($_POST['patrimonio']);

    $id_usuario = $_SESSION['id_usuario'];



    if (!empty($descricao) && !empty($id_tipo) && !empty($id_usuario) && !empty($id_localizacao)) {
        $a->conectar("tecnolist", "localhost", "root", "");

        if ($a->msgErro == "") {

            if ($a->cadastrar_ativos($descricao, $id_tipo, $id_usuario, $id_localizacao, $patrimonio)) {
                echo "<script>alert('Ativo cadastrado com sucesso')</script>";
            } else {
                echo "<script>alert('Ativo já cadastrado!');</script>";
            }
        } else {
            echo "Erro: " . $a->msgErro;
        }
    } else {
        echo "<script>alert('Preencha todos os campos!');</script>";
    }
}
?>