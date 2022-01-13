<?php

 if(!empty($_GET['id_chamado'])){
     include_once('Lista.php');

     $id = $_GET['id_chamado'];

     $sql_select = "SELECT * FROM chamado WHERE id_chamado = $id";

     $sql_result = $conn->query($sql_select);

     if($sql_result->num_rows > 0) {

        $sql_delete = "DELETE FROM  chamado WHERE id =$id";
        $result_delete = $conn->query($sql_delete);

        echo "Deletado com sucesso";
     }
 }


?>