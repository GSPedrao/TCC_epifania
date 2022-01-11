<?php
require_once('../php/conecao.php');

Class Chamado
{
    private $pdo;  // oque fará acesso ao banco de dados
    public $msgErro = ""; 
   

    public function conectar($nome, $host, $usuario, $senha)
    {
        global $pdo;
        global $msgErro;
        try{
        $pdo = new PDO("mysql:dbname=".$nome.";host=".$host,$usuario,$senha); //Parâmetros exigidos pelo PDO
        } catch (PDOException $e) {
        $msgErro = $e->getMessage(); //caso de erro
        }
    }   


    public function cadastrar_chamados($descricao, $id_ativo, $id_usuario){
        
        //verifica se já está cadastrado 
        global $pdo; 
        global $msgErro;

        $sql = $pdo->prepare("SELECT id_chamado from chamado where descricao = :d"); //procura se já existe um usuario cadastrado
        $sql->bindValue(":d", $descricao);
        $sql->execute();

        if($sql->rowCount() > 0)
        {
            return false; //já cadastrado
        }else{
            //se não, cadastrar
            $sql = $pdo->prepare("INSERT INTO chamado (descricao, data_abertura, id_ativo, id_usuario)
             VALUES (:d, NOW(), :a, :u)");
            $sql->bindValue(":d", $descricao);
            $sql->bindValue(":a",  $id_ativo);
            $sql->bindValue(":u", $id_usuario);
            $sql->execute();

            global $id_usuario;



            return true;  
        }
        
    }

}

?>