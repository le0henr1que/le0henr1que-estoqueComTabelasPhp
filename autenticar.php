<?php  
include_once('conexao.php');
session_start();
?>

<?php  
if(empty($_POST['usuario']) || empty($_POST['senha']) )
{	$_SESSION['Erro10'] = "<div class='uk-alert-danger' uk-alert>
    <a class='uk-alert-close' uk-close></a>
    <p>Campo vazio</p>
    </div>";
    //variavel session recebe uma mensagem de erro
    header("Location: Login.php");
    //joga o usuario para a tela adicionara.php
    die();
    //encerra o andamento do codigo(cadastraraluno.php)
     }

    $usuario = mysqli_real_escape_string($conexao, $_POST['usuario']);   
    $senha = mysqli_real_escape_string($conexao, $_POST['senha']); 
    
    $query = "SELECT  * FROM usuarios where usuario = '$usuario' and senha = '$senha' ";

    $result = mysqli_query($conexao, $query);
    $dado = mysqli_fetch_array($result);                                      
    $linha = mysqli_num_rows($result);
    $linha_count = mysqli_num_rows($result_count);

    if($linha > '0')
    {
        $_SESSION['usuario'] = $usuario;
        $_SESSION['nome_usuario'] = $dado['nome'];
        $_SESSION['nivel_usuario'] = $dado['nivel'];
        $_SESSION['cpf_usuario'] = $dado['cpf'];
        $_SESSION['img'] = $dado['img'];
      
      
       

        if( $_SESSION['nivel_usuario'] == 'Administrador')
        {
            header('Location:paineladm.php');
            exit();
        }
        if( $_SESSION['nivel_usuario'] == 'Compras')
        {
            
            header('Location:painelcompra.php');
            exit();
        }
        if( $_SESSION['nivel_usuario'] == 'Bloqueador')
        {
            header('Location:painelbloq.php');
            exit();
        }
        if( $_SESSION['nivel_usuario'] == 'Estoque')
        {
            header('Location:painel.php');
            exit();
        }
        if( $_SESSION['nivel_usuario'] == 'Operações')
        {
            header('Location:painelop.php');
            exit();
        }

    }
    else{
        $_SESSION['nao_autenticado'] = true;
        header('Location:login.php');
    }


?>