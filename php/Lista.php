<?php
    session_start();
    if(!isset($_SESSION['id_usuario']))
    {
        header("location: ../index.php");
        exit;
    }
    
?>

<!DOCTYPE html> 
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista</title>
</head>

<body>
    <header></header>
    <div>
        <div>
            <table>
                <tr> 
                    <td>1</td>
                    <td>Comprar Paçocas</td>
                    <td>data</td>
                    <td>Nivel de Urgencia</td>
                    <td>Andamento</td>
                    
                </tr>
            </table>
        </div>
        
    </div>
</body>

</html>