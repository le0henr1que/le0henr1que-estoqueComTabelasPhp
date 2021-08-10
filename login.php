<?php  
include_once('conexao.php');
session_start();
?>


<!DOCTYPE html>
<html lang="pt-br">
    <head>
    <title>Login</title>
        

        <link rel="sortcut icon" href="img/pacotes.png" type="image/x-icon" />
         
        <!--metas-->
        <meta charset="utf-8">
        <meta name="viewport" content="width=devicec-width, intial-scale=1, shrink-to-fit=no"><!--deixar inspecionado-->
        <meta name="description" content="Controle de saida estoque T4S"><!--descrição que irá aparecer na hora da pesquisa-->
        <meta name="author" content=""><!--Autor do site-->
        <meta name="keybords" contents=""><!--palavras chaves-->
        <!--liks-->
             
        <link rel="stylesheet" type="text/css" href="css/style.css"><!--adicionando a folha de estilo-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.5.4/dist/css/uikit.min.css" /><!--botstrap-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous"><!--botstrap-->
  
        
    </head>
        <body>
            <!--abrindo uma div para adicionar o formulario-->
         
            <div class="uk-container uk-box-shadow-xlarge uk-position-center uk-container-large">
                <!--adicionado o formulario-->
                <br>
                <br>
                <form method="POST" action="autenticar.php">
                    <fieldset class="uk-fieldset">
                        <!--adicionado a logo centralizada-->
                        <center>
                            <legend class="uk-legend"><img src="img/pacotes.png" width="120" ></legend>
                        </center>
                        <!--criando campo de teto usuario-->
                        <div class="uk-margin">
                            <div class="uk-inline">
                                <span class="uk-form-icon" uk-icon="icon: user"></span>
                                <input class="uk-input border-black" type="text" name="usuario" id="email">
                            </div>
                        </div>
                        <!--criando campo de texto senha-->
                        <div class="uk-margin">
                            <div class="uk-inline">
                                <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: lock"></span>
                                <input class="uk-input border-black" type="password" name="senha" id="senha">
                            </div>
                        </div>
                        <center>
                            <button type="submit" name="button" class="btn btn-dark">Entrar</button>
                        </center>
                    </fildset>
                    <br>
                </form>
                    <center>
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Manter Conectado</label>
                        <br>
                        <a href="#" class="position1">Esqueci a senha</a>
                        <br>
                        <label class="form-check-label" for="exampleCheck1"></label>
                        <br>
                        <?php
                            if (isset($_SESSION['nao_autenticado'])) 
                            // Testa se a variavel que valida os campos tem alguma coisa
                            {
                                echo $_SESSION['nao_autenticado'] = "<div class='uk-alert-danger' uk-alert>
                                <a class='uk-alert-close' uk-close></a>
                                <p>Usuario ou senha incorreto</p>
                            </div>";
                                //Exibe o que esta dentro da variavel
                                unset ($_SESSION['nao_autenticado']);
                                //Esvazia ela
                                
                            }
                            if (isset($_SESSION['Erro10'])) 
                            // Testa se a variavel que valida os campos tem alguma coisa
                            {
                                echo $_SESSION['Erro10'];
                                //Exibe o que esta dentro da variavel
                                unset ($_SESSION['Erro10']);
                                //Esvazia ela
                            }
                             ?>
                        <label class="form-check-label" for="exampleCheck1"></label>
                        <br>
                        <label class="form-check-label" for="exampleCheck1"></label>
                        <br>
                        <label class="form-check-label" for="exampleCheck1"></label>
                      
                        </center>
            </div>
            
            <!--links js-->
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/uikit@3.5.4/dist/js/uikit.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/uikit@3.5.4/dist/js/uikit-icons.min.js"></script>
        </body>
</html>