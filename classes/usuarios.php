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

    
    public function logar($nome, $senha)
    {
        global $pdo;
        global $msgErro;
         //verificar se já está cadastrado
         $sql = $pdo->prepare("SELECT id_usuario FROM usuario WHERE nome = :n AND senha = :s"); 
         $sql->bindValue(":n", $nome);
         $sql->bindValue(":s",md5($senha));  //md5 : Criptografa a senha
         $sql->execute();
         if($sql->rowCount() > 0)
         {  
              //Entrar
              $dado = $sql->fetch(); 
              session_start();  
              $_SESSION['id_usuario'] = $dado['id_usuario'];

  
              $verificar = $pdo->query("SELECT * FROM usuario_grupo"); //procura coluna para nivel de acesso
              while ($linha = $verificar->fetch(PDO::FETCH_ASSOC)){ //Verifica PDO
                 if($linha['id_gdu']){   //se variavel linha for igual ao nome
                  $nivel = $linha['nivel']; // linha recebe valor da coluna nivel
                  switch ($nivel) {  
                    case '2':
                        header("location: ./php/Lista.php");   
                    break;

                    case '1':
                        header("location: ./php/form.php");
                    break;

                default:
                    echo "Usuario sem acesso";
                    break;
                   }  

                  }
                }
                
                

              
              return true; //Logado com sucesso
         }
         else
         {
             return false; //Não conseguiu logar
         }

        
    }

}


?>