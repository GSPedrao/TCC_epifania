<?php
require_once('conecao.php');


session_start();
if (!isset($_SESSION['id_usuario'])) {
    header("location: ../index.php");
    exit;
} 

if(!empty($_GET['search']))
{
    $data = $_GET['search'];
    $sql = "SELECT * FROM  chamado Where id_chamado LIKE '%$data%' or id_usuario LIKE '%$data%' or descricao LIKE '%$data%' ORDER BY id_chamado DESC";
    
}else{
    $sql = "SELECT * FROM  chamado ORDER BY id_chamado DESC";
} 


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

    <div class="box-search">   <!--barra de pesquisa-->
        <input type="search" placeholder="pesquisar" id="pesquisar">
        <button onclick="searchData()">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
            </svg>
        </button>

    </div>
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
                    while ($chamado_data = mysqli_fetch_assoc($result)) //enquanto chamada_data receber o result e retornar matriz associativa
                    {
                        echo "<tr>";
                        echo "<td>" . $chamado_data['id_chamado'] . "</td>";

                        $resultado_user = "SELECT * FROM usuario WHERE '$chamado_data[id_usuario]' = id_usuario";
                        $re_user = mysqli_query($conn, $resultado_user);
                        while ($row_user = mysqli_fetch_assoc($re_user)) { ?>
                            <td> <?php echo $row_user['nome']; ?> </td> <?php
                                                                        }

                                                                        echo "<td>" . $chamado_data['descricao'] . "</td>";

                                                                        $resultado_ativo = "SELECT * FROM ativo WHERE '$chamado_data[id_ativo]' = id_ativo";
                                                                        $re_ativo = mysqli_query($conn, $resultado_ativo);
                                                                        while ($row_ativo = mysqli_fetch_assoc($re_ativo)) { ?>
                            <td> <?php echo $row_ativo['descricao']; ?> </td> <?php
                                                                            }

                                                                            echo "<td>" . $chamado_data['data_abertura'] . "</td>";

                                                                            if ($chamado_data = 1) {
                                                                                echo "<td>Em andamento</td>";
                                                                            }

                                                                            echo "<td>
                        <a href='delete.php?id=$chamado_data[id_chamado]'>
                        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16'>
                        <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z'/>
                      </svg>
                        
                        </a>
                        </td>";
                                                                        }


                                                                                ?>
                </tbody>
            </table>
        </div>

    </div>
</body>
<script>
        var search = document.getElementById('pesquisar')

        search.addEventListener("Keydown", function(event){ //pega a variavel e analisa a tecla que você clicou
            if(event.key === "Enter") // se for Enter ele chama a função
            {
                searchData();
            }
        });
        

        function searchData()
        {
            window.location = 'Lista.php?search='+search.value; 
        }
</script>

</html>