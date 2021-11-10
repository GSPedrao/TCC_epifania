<?php

Class Usuario
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
 
   /* public function cadastrar($nome, $senha)
    {
        global $pdo;
        //verificar se já está cadastrado
        $sql = $pdo->prepare("SELECT id_usuario FROM login  WHERE nome = :n"); // Procurar se já existe o usuario
        $sql->bindValue(":n", $nome);
        $sql->execute();
        if($sql->rowCount() > 0) //verificar
        {
            return false; //já cadastrado
        }
        else
        {
             //Se não, cadastrar
             $sql = $pdo->prepare("INSERT INTO login (nome, senha) VALUES (:n, :s)");
             $sql->bindValue(":n", $nome);
             $sql->bindValue(":s",md5( $nome)); //md5 : Criptografa a senha
             $sql->execute();
             return true;  
        }

        

    }*/

    public function logar($nome, $senha, $nivel)
    {
        global $pdo;
         //verificar se já está cadastrado
         $sql = $pdo->prepare("SELECT id_usuario FROM login WHERE nome = :n AND senha = :s AND nivel = :l"); 
         $sql->bindValue(":n", $nome);
         $sql->bindValue(":l", $nivel);
         $sql->bindValue(":s",md5($senha));  //md5 : Criptografa a senha
         $sql->execute();
         if($sql->rowCount() > 0)
         {
              //Entrar
              $dado = $sql->fetch();
              session_start();  
              $_SESSION['id_usuario'] = $dado['id_usuario'];
              $_SESSION['nivel'] = $dado['nivel'];
              return true; //Logado com sucesso
         }
         else
         {
             return false; //Não conseguiu logar
         }

        
    }

}


?>