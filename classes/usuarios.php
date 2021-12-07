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


    public function cadastrar($nome, $senha, $grupo){
        
        global $pdo; //verifica se já está cadastrado 

        $sql = $pdo->prepare("SELECT id_usuario from usuario where nome = :n"); //procura se já existe um usuario cadastrado
        $sql->bindValue(":n", $nome);
        $sql->execute();

        if($sql->rowCount() > 0)
        {
            return false; //já cadastrado
        }else{
            //se não, cadastrar
            $sql = $pdo->prepare("INSERT INTO usuario (nome, senha) VALUES (:n, :s");
            $sql->bindValue(":n", $nome);
            $sql->bindValue(":s",md5( $nome)); //md5 : Criptografa a senha
            $sql->execute();

            return true;  
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

 
              //nivel de acesso
              $verificar = $pdo->query("SELECT * FROM usuario_grupo"); //procura coluna para nivel de acesso
              while ($linha = $verificar->fetch(PDO::FETCH_ASSOC)){ //enquanto 
                 if($linha['id_usuario'] == $_SESSION['id_usuario']){   //se variavel linha for igual ao nome
                  $nivel = $linha['id_grupo_de_usuario']; // linha recebe valor da coluna nivel
                  switch ($nivel) {
                    case '2':
                        header("location: ./php/Lista.php");   
                    break;

                    case '3':
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