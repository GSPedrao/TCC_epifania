<?php
  require_once("../classes/usuarios.php");
  include_once("conecao.php");
  $u = new Usuario;
  session_start();
  if(!isset($_SESSION['id_usuario']))
  {
      header("location: ../index.php");
      exit;
  } else if($_SESSION['id_grupo'] !=2 ){
    header("location: ../index.php");
}
  
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<body>
    <div class="aa">

        <form method="POST">
            <div class="nome">
                <label type="text" aria-placeholder= "Digite seu nome">Nome</label>
                <input type="text" name="nome" id="nome">
            </div>
            <br>
            <div class="senha">
                <label type="password" aria-placeholder="Digite sua senha">Senha</label>
                <input type="password" name="senha" id="senha">
            </div>
            <br>
            <div class="confirma">
                <label type="password" aria-placeholder="Confirme sua senha">Confirmar sua senha</label>
                <input type="password" name="csenha" name="confirma" id="confirma">
            </div>
            <br>
            <label>Selecione o grupo de usuario</label>
            <select class="form-select" name="selecionaGrupo"  aria-label="Default select example">
                <option></option>
                <?php
                    $resultadoGrupo = "SELECT * FROM grupo_de_usuario";
                    $re_grupo = mysqli_query($conn, $resultadoGrupo);
                    while($row_grupo = mysqli_fetch_assoc($re_grupo)){ ?>
                         <option value="<?php echo $row_grupo['id_grupo']?>">
                         <?php echo $row_grupo['nome_grupo']; ?>
                         </option> <?php
                    }
                ?>
            </select>
            <br>
          <input style="border-radius: 30px;" class="btn btn-primary" type="submit" value="salvar"></input>
        </form>
    </div>
</body>
</html>


<?php
   //vereficar se clicou no nome
   if(isset($_POST['nome'])){
       $nome = addslashes($_POST['nome']);
       $senha = addslashes($_POST['senha']);
       $csenha = addslashes($_POST['csenha']);
       $grupo = addslashes($_POST['selecionaGrupo']);
       
   

      if(!empty($nome) && !empty($senha) && !empty($csenha) && !empty($grupo)){
          $u->conectar("tecnolist", "localhost", "root", "");
              
          if($u->msgErro == ""){

              if($senha == $csenha){

                  if($u->cadastrar($nome, $senha, $grupo)){
                     echo "<script>alert('Usuario cadastrado com sucesso')</script>";
                   }else{
                       echo "<script>alert('Usuario já cadastrado!');</script>";
                    }

               }else{
               echo "<script>alert('Senha e confirmar senha não correspondem!');</script>";
               }
           
            }else{
           echo "Erro: " . $u->msgErro;
           }
        
        
   
        }else{
           echo "<script>alert('Preencha todos os campos!');</script>";
        }
   }
?>