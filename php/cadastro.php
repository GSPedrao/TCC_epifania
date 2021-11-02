<?php
    require_once '../classes/usuarios.php';
    $u = new Usuario;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cadastrar</title>
    <link rel="stylesheet" href="../css/Form.css">
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</head>
<body>
    <div class="register">
        <div class="row">
            <div class="col-md-3 register-left">
                <!--Logo e comentários-->
                <img src="../imgs/logo-colegios-maristas-vertical-Branco.png"  alt=""/> 
                <h3>Bem Vindo!!</h3>
                <p>You are 30 seconds away from earning your own money!</p>
            </div>
            <div class="col-md-9 register-right">
              
                <!--Login-->
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <h3 class="register-heading">Login</h3>
                        <div class="row register-form">
                            <div class="col-md-6" id="CorpoForm">

                                <form method="POST">
                                <div class="form-floating">
                                    
                                    <input type="text" class="form-control" placeholder="Nome" value="" />
                                    <label>Nome</label>
                                </div>
                                <br>
                                <div class="form-floating">
                                    <input type="password" class="form-control" placeholder="Senha" value="" />
                                    <label>Senha</label>
                                </div>
                              
                                <input type="submit" class="btnLogar"  value="Logar"/>
                                </form>

                            </div>
                        </div>



                         

                    </div>
                   
                </div>
            </div>
        </div>
    
        <?php
         //Verificar se clicou no botao
         if(isset($_POST['nome']))
         {
             $nome = addslashes($_POST['nome']);
             $senha = addslashes($_POST['senha']);  
             //verificar se está vazio
             if(!empty($nome) && !empty($senha))
             {
                $u->conectar("sistema","Localhost","root",""); //conectar ao banco
                if($u->msgErro == "")
                {

                  if(  $u->cadastrar($nome, $senha)) 
                    {
                        echo "Cadastro com sucesso!!";
                    }else{
                        
                        echo "Nome ou senha já cadastrado!";
                    }

                }else{
                    echo "Erro:".$u->msgErro;
                }   

             }
             else 
             {
                 echo "Preencha os campos obrigatórios!!";
             }
         }

?>
    	
</body>
</html>