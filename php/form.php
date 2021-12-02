<?php
    include('../classes/usuarios.php');
    session_start();
    if(!isset($_SESSION['id_usuario']))
    {
        header("location: ../index.php");
        exit;
    }   
    
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
        <div class="box">
            <p>Formulario de pedidos</p>
            <label for="text">Colaborador</label>
            <input type="text" placeholder="Digite o seu nome" name="nome" id="nome"/>
        </div>
        <br>
        <div class="box">
            <label for="text">O que é o pedido</label>
            <input type="text" placeholder="Digite o seu pedido" name="pedido" id="pedido"/>
        </div>
        <br>
        <div class="box">
            <label for="text">Local do problema</label>
            <input type="text" placeholder="Local do problema" name="problema" id="problema"/>
        </div>
        <br>
        <div class="box">
            <label for="text">Observação</label>
            <input type="text" placeholder="Digite a sua observação" name="obs" id="obs"/>
        </div>

    </div>
</body>
</html>


