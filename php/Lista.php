<?php
require_once('conecao.php');


    session_start();
    if(!isset($_SESSION['id_usuario']))
    {
        header("location: ../index.php");
        exit;
    } 
    
     $sql = "SELECT * FROM  chamado ORDER BY id_chamado DESC";
     $result = $conn->query($sql);

?>

<!DOCTYPE html> 
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista</title>
</head>

<body>
   <a href="cadastrese.php">usuario</a> 
   <a href="Cadativo.php">ativo</a>
    <header></header>
    <div>
        <div>
            <table>
                <thead>
                    <tr>
                        <th>Número de chamados</th>
                        <th>Colaborador</th>
                        <th>Descrição</th>
                        <th>Ativo</th>
                        <th>Data</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while($chamado_data = mysqli_fetch_assoc($result))
                    {
                        echo "<tr>";
                        echo "<td>" . $chamado_data['id_chamado'] . "</td>";

                        $resultado_user = "SELECT * FROM usuario WHERE '$chamado_data[id_usuario]' = id_usuario";
                        $re_user = mysqli_query($conn, $resultado_user);
                        while ($row_user = mysqli_fetch_assoc($re_user)) { ?> 
                            <td> <?php  echo $row_user['nome']; ?> </td> <?php
                        }
                       
                        echo "<td>" . $chamado_data['descricao'] . "</td>";
                        
                        $resultado_ativo = "SELECT * FROM ativo WHERE '$chamado_data[id_ativo]' = id_ativo";
                        $re_ativo = mysqli_query($conn, $resultado_ativo);
                        while ($row_ativo = mysqli_fetch_assoc($re_ativo)) { ?> 
                            <td> <?php  echo $row_ativo['descricao']; ?> </td> <?php
                        }

                        echo "<td>" . $chamado_data['data_abertura'] . "</td>";
                        
                        if($chamado_data = 1){
                            echo "<td>Em andamento</td>";
                        }
                    }


                    ?>
                </tbody>
            </table>
        </div>
        
    </div>
</body>

</html>