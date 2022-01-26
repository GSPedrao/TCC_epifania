<?php
require_once('conecao.php');


session_start();    
if (!isset($_SESSION['id_usuario'])) {
    header("location: ../index.php");
    exit;
}

if (!empty($_GET['search'])) {
    $data = $_GET['search'];

    $sql = "SELECT * FROM chamado cha INNER JOIN usuario usr ON cha.id_usuario=usr.id_usuario 
    WHERE cha.id_chamado LIKE '%$data%' or cha.descricao LIKE '%$data%' or usr.nome LIKE '%$data%'
    ORDER BY cha.id_chamado DESC"; 
} else {
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

    <div class="box-search"w>
        <!--barra de pesquisa-->
        <input type="search" placeholder="pesquisar" id="pesquisar">
        <button onclick="searchData()"> <!--botao-->
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
            </svg>
        </button>

    </div>
    <div>   
        <div>
            <table border="2">
                <thead>
                    <tr>
                        <th>Chamados</th>
                        <th>Colaborador</th>
                        <th>Descrição</th>
                        <th>Ativo</th>
                        <th>Data</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
<?php
while($chamado_data = $result->fetch_assoc()) //enquanto chamada_data receber o result e retornar matriz associativa
{
    //var_dump($chamado_data);
    extract($chamado_data);
    echo "<tr>";
    echo "<td>" . $id_chamado . "</td>";

    $resultado_user = "SELECT * FROM usuario WHERE id_usuario = '$id_usuario' ";
    $re_user = mysqli_query($conn, $resultado_user);
    while ($row_user = mysqli_fetch_assoc($re_user)) { ?>
    <td> <?php echo $row_user['nome']; ?> </td> <?php
    }

    echo "<td>" . $descricao . "</td>";

    $resultado_ativo = "SELECT * FROM ativo WHERE '$id_ativo' = id_ativo";
    $re_ativo = mysqli_query($conn, $resultado_ativo);
    while ($row_ativo = mysqli_fetch_assoc($re_ativo)) { ?>
    <td> <?php echo $row_ativo['patrimonio']; ?> </td> <?php
    }

    echo "<td>" . $data_abertura . "</td>";

    if ($status == 1) {
        echo "<td>Em andamento</td>";
    }else{
        echo "<td>Concluído</td>";
    }

     echo "<td>
                                                                            
        <a href='delete.php?id=$id_chamado' title='Deletar'>
            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16'>
            <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z'/>
            </svg>
                        
        </a>
        </td>";

     echo "<td>
        <a href='concluido.php?status=$id_chamado'>
        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-bookmark-check' viewBox='0 0 16 16'>
        <  path fill-rule='evenodd' d='M10.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z'/>
          <path d='M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z'/>
          </svg>
        </a>
     </td>";
             

    echo "</tr>";
}


?>
                </tbody>
            </table>
        </div>

    </div>
</body>
<script>
    var search = document.getElementById('pesquisar')

    search.addEventListener("Keydown", function(event) { //pega a variavel e analisa a tecla que você clicou
        if (event.key === "Enter") // se for Enter ele chama a função
        {
            searchData();
        }
    });


    function searchData() {
        window.location = 'Lista.php?search=' + search.value;
    }
</script>

</html>