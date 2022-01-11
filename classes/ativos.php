<?php

Class Ativos
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


    public function cadastrar_ativos($descricao, $id_tipo, $id_usuario, $id_localizacao, $patrimonio){
        
        //verifica se já está cadastrado 
        global $pdo; 
        global $msgErro;

        $sql = $pdo->prepare("SELECT id_ativo from ativo where patrimonio = :p"); //procura se já existe um usuario cadastrado
        $sql->bindValue(":p", $patrimonio);
        $sql->execute();

        if($sql->rowCount() > 0)
        {
            return false; //já cadastrado
        }else{
            //se não, cadastrar
            $sql = $pdo->prepare("INSERT INTO ativo (descricao, id_tipo, id_usuario, id_localizacao, patrimonio)
             VALUES (:d, :t, :u, :l, :p)");
            $sql->bindValue(":d", $descricao);
            $sql->bindValue(":t",  $id_tipo);
            $sql->bindValue(":u", $id_usuario);
            $sql->bindValue(":l", $id_localizacao);
            $sql->bindValue(":p", $patrimonio);
            $sql->execute();

            return true;  
        }
        
    }

}

?>