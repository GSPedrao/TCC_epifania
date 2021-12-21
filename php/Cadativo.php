<?php
include_once('conecao.php');


session_start();
if (!isset($_SESSION['id_usuario'])) {
    header("location: ../index.php");
    exit;
}

$nameresult = "SELECT * from usuario";
$resultado_nome = mysqli_query($conn, $nameresult);
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
        <form>
            <div class="input-group mb-4" id="#">
                <h1></h1>
                <p>Colaborador</p>
                <input type="text" id="#" class="form-control" value="<?php echo $LNome['nome']; ?>">
                <br>
                <p>Informação do ativo</p>
                <select id="#">
                    <option value="#"></option>
                </select>
                <br>
                <p>Tipo</p>
                <input type="text" id="#" class="form-control">
                <br>
                <div>
                    <label>localização</label>
                    <br>
                    <select>
                        <option></option>
                        <?php
                        $resultadoGrupo = "SELECT * FROM localizacao";
                        $re_grupo = mysqli_query($conn, $resultadoGrupo);
                        while ($row_grupo = mysqli_fetch_assoc($re_grupo)) { ?>
                            <option value="<?php echo $row_grupo['id_localizacao'] ?>">
                                <?php echo $row_grupo['descricao']; ?>
                            </option> <?php
                                    }
                                        ?>
                    </select>
                </div>
                <p>Patrimonio</p>
                <input type="text" id="#" class="form-control">
                <br>
                <p>Descrição</p>
                <textarea>

            </div>
            <input type="buttom">
        </form>
    </div>
</body>

</html>