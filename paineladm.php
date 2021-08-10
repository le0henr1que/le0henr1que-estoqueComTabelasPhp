<?php
//Incluir a conexão com banco de dados
include_once 'conexao.php';

?>
<?php

session_start();
include_once('verificar_autenticacao.php');

?>
<?php
if ($_SESSION['nivel_usuario'] != 'Administrador') {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE HTML>
<html>

<head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src=" https://docs.google.com/spreadsheets/d/1BEtiBqFgOuFMe7K_9THV4vgaLCG8yRr-pQ-HrkvxckE/gviz/tq?range=A2:D16"></script>
    <script type="text/javascript" src="graficoLinhas.js"></script>

    <meta charset="utf-8">
    <title>Estoque <?php echo   $_SESSION['nivel_usuario']; ?></title>


    <link rel="sortcut icon" href="img/pacotes.png" type="image/x-icon" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.5.4/dist/css/uikit.min.css" />
    <!--botstrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <!--botstrap-->
    <style>

    </style>

</head>


<body>
    <!--abertura da Navbar-->
    <nav class="uk-navbar bg-dark uk-navbar-container fixed-top uk-margin uk-box-shadow-large">
        <!--abertura das divs de posicionamento-->
        <div class="uk-navbar-left">
            <!--inserindo span para abertura do menu-->
            <a class="uk-navbar-toggle" uk-navbar-toggle-icon href="#offcanvas-usage" uk-toggle style=" margin-left: 20px;"> </a>
        </div>

        <div class="uk-navbar-right">

            <div class="container">
                <svg style="color:white;  margin-right: 40px;" xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-bell-fill" viewBox="0 0 16 16">
                    <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zm.995-14.901a1 1 0 1 0-1.99 0A5.002 5.002 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901z" />
                </svg>
                <button class="uk-button uk-button-link" type="button"><img src="img/Perfil/<?php echo $_SESSION['img']; ?>" class="rounded-circle" width="50"> </button>
                <div uk-dropdown="pos: bottom-justify">
                    <ul class="uk-nav uk-dropdown-nav">



                        <li> <a href="logout.php" class="uk-link-reset "><span class="uk-margin-small-right" uk-icon="icon: sign-out; ratio: 1;"></span>Sair</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!--fechamento da Navbar-->
    </nav>

    <div id="offcanvas-usage" class="fixed-top" uk-offcanvas>
        <div class="uk-offcanvas-bar bg-dark ">

            <div uk-grid>
                <div class="uk-width-large@m">
                    <center><img src="img/Perfil/<?php echo $_SESSION['img']; ?>" class="rounded-circle" width="120"></center>
                    <br>
                    <center>
                        <h4><?php echo  $_SESSION['nome_usuario']; ?></h4>
                    </center>
                    <center><?php echo   $_SESSION['nivel_usuario']; ?></center>
                    <br>
                    <ul class="uk-nav uk-nav-default uk-offcanvas-close" style="margin-top: 250px; margin-right: 5px; " uk-switcher="connect: #component-nav; animation: uk-animation-fade">
                        <li class="uk-nav-divider" style="width:300px;"></li>
                        <br>
                        <li><a href="#" class="uk-text"><span class="uk-margin-small-right " uk-icon="icon: users"></span> Usuarios</a></li>
                        <br>
                        <li><a href="#" class="uk-text"><span class="uk-margin-small-right" uk-icon="icon: database"></span> Estoque de Insumos</a></li>
                        <br>
                        <li><a href="#" class="uk-text"><span class="uk-margin-small-right" uk-icon="icon:  plus"></span>Cadastrar</a></li>
                        <br>


                        <li><a href="#" class="uk-text"><span class="uk-margin-small-right" uk-icon="icon:  bell"></span>Notificações</a></li>

                        <br>

                    </ul>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <div class="uk-width-expand@m">
        <nav class="uk-navbar-container" uk-navbar>
            <div class="uk-navbar-left">
            </div>
        </nav>
        <ul id="component-nav" class="uk-switcher">
            <li>

                <div class="cont">
                    <div class="uk-navbar-item-left">

                        <form class="uk-search uk-search-navbar" method="GET">
                            <button type="submit" name="buttonPesquisar" uk-search-icon></button>
                            <input class="uk-search-input" name="txtpesquisar" type="search" placeholder="Consultar Usuário...">

                            <?php
                            if (isset($_GET["buttonPesquisar"]) and $_GET["txtpesquisar"] != '') {
                                $nome = $_GET["txtpesquisar"] . '%';
                                $cpf = $_GET["txtpesquisar"];
                                $query = "SELECT * from usuarios where nome LIKE '$nome' or cpf = '$cpf' order by nome asc";
                                $result_count = mysqli_query($conexao, $query);
                            } else {
                                $query = "SELECT * from usuarios order by id desc limit 10";
                                $query_count = "SELECT * from usuarios ";
                                $result_count = mysqli_query($conexao, $query_count);
                            }
                            $result = mysqli_query($conexao, $query);
                            $linha = mysqli_num_rows($result);
                            $linha_count = mysqli_num_rows($result_count);
                            if ($linha == '') {
                                echo "<h3>Não foram encontrados dados cadastrados no banco</h3>";
                            } else {
                            ?>

                        </form>
                    </div>

                    <table class="uk-table uk-table-striped table-striped uk-box-shadow-medium" style="font-size:12px;">
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
                                <th>Nome</th>
                                <th>CPF</th>
                                <th>Usuarios</th>
                                <th>Senha</th>
                                <th>Setor</th>
                                <th>Data</th>
                                <th>Ações</th>
                                <th></th>

                            </tr>
                        </thead>
                        <?php
                                while ($res = mysqli_fetch_array($result)) {
                                    $nome = $res["nome"];
                                    $cpf = $res["cpf"];
                                    $usuario = $res["usuario"];
                                    $senha = $res["senha"];
                                    $nivel = $res["nivel"];
                                    $data = $res["data"];
                                    $id = $res["id"];
                        ?>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td><?php echo $nome; ?></td>
                                    <td><?php echo $cpf; ?></td>
                                    <td><?php echo $usuario; ?></td>
                                    <td><?php echo $senha; ?></td>
                                    <td><?php echo $nivel; ?></td>
                                    <td><?php echo $data; ?></td>
                                    <td>
                                        <a href="alterar.php?acao=usuarios&func=edita&id=<?php echo $id; ?>" class="uk-icon-link uk-margin-small-right" uk-icon="file-edit"></a>
                                        <a href="paineladm.php?acao=usuarios&func=excluir&id=<?php echo $id; ?>" lass="uk-icon-link" uk-icon="trash"></a>
                                    </td>
                                    <td></td>

                                </tr>
                            <?php
                                }
                            ?>
                            </tbody>
                            <tfoot>
                                <tr><span class="text-muted">
                                        <td colspan="7" align="right">Registro:<?php echo $linha_count ?></td>
                                    </span></tr>
                            </tfoot>
                    </table>
                <?php
                            }
                ?>
                </div>
            </li>

            <li>

                <div class="cont">
                    <main role="main" class="col-md-12 ml-sm-auto col-lg-12 px-4">
                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">

                            <div class="btn-toolbar mb-2 mb-md-0">
                                <div class="btn-group mr-2">
                                    <button class="btn btn-sm btn-outline-secondary">Compartilhar</button>
                                    <button class="btn btn-sm btn-outline-secondary">Exportar</button>
                                </div>

                                <div class=" uk-navbar-item-left">
                                    <span uk-search-icon></span>
                                    <form method=" POST" id="form-pesquisa" action="" class="uk-search uk-search-navbar">
                                        <input type="text" name="pesquisa" class="uk-search-input" id="pesquisa" placeholder="Consultar Inventário...">
                                    </form>

                                </div>
                            </div>
                        </div>
                        <?php
                        if (isset($_POST["pesquisa"])  != '') {
                            $desc = $_POST["pesquisa"] . '%';
                            $area = $_POST["pesquisa"];
                            $query = "SELECT * from produtos where descri LIKE '$desc' or area = '$area' order by descri asc";
                            $result_count = mysqli_query($conexao, $query);
                        } else {
                            $query = "SELECT * from produtos order by id desc limit 10";
                            $query_count = "SELECT * from produtos ";
                            $result_count = mysqli_query($conexao, $query_count);
                        }

                        $result = mysqli_query($conexao, $query);
                        $linha = mysqli_num_rows($result);
                        @$linha_count = mysqli_num_rows($result_count);

                        if ($linha == '') {
                            echo "<h3>Não foram encontrados dados cadastrados no banco</h3>";
                        } else {
                        ?>
                            <table class="uk-table uk-table-striped uk-box-shadow-medium resultado" style="font-size:12px;"">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Imagem</th>
                                        <th>Descrição</th>
                                        <th>Área</th>
                                        <th>Quantidade</th>
                                        <th>Medida</th>
                                        <th>Ações</th>
                                        <?php
                                        while ($res = mysqli_fetch_array($result)) {

                                            $desc = $res["descri"];
                                            $area = $res["area"];
                                            $est = $res["inicial"];
                                            $medida = $res["unidade_medida"];
                                            $img = $res["img"];
                                            $id = $res["id"];

                                        ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td>
                                            <div uk-lightbox>
                                                <a class=" uk-button uk-button" href="img/insumo/<?php echo $img; ?>" data-caption="<?php echo $desc; ?>"><img src="img/insumo/<?php echo $img; ?>" width="40">
                                </td></a>
                </div>
                <td><?php echo $desc; ?></td>
                <td><?php echo $area; ?></td>
                <td><?php echo $est; ?></td>
                <td><?php echo $medida; ?></td>
                <td>
                    <a href="alterar.php?acao=usuarios&func=edita2&id=<?php echo $id; ?>" class="uk-icon-link uk-margin-small-right" uk-icon="file-edit"></a>
                    <a href="paineladm.php?acao=usuarios&func=excluir2&id=<?php echo $id; ?>" lass="uk-icon-link" uk-icon="trash"></a>
                </td>
                </tr>
            <?php
                                        }
            ?>
            <tfoot>
                <tr><span class="text-muted">
                        <td colspan="7" align="right">Registro:<?php echo $linha_count ?></td>
                    </span></tr>
            </tfoot>
            </tbody>
            </table>


        <?php
                        }
        ?>
    </div>
    </li>
    <li>
        <br>
        <br>

        <main role="main" class="col-md-12">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h3" style="color:gray"> <span uk-icon="icon: users; ratio: 1.5"></span> Cadastrar Usuário</h1>

            </div>
        </main>
        <div class="container ">


            <br>
            <form class="uk-grid-small needs-validation" uk-grid method="POST" novalidate enctype="multipart/form-data">
                <div class="col-md-3">
                    <div class="uk-width-1-2">
                        <img src="img/user.png" class="rounded-circle" width="180">
                        <div class=" js-upload" uk-form-custom style="color:gray; width:400px;">
                            <input type="file" multiple name="img">
                            <br>
                            <button style="color:gray;margin-left:6x;" class="uk-button uk-button" type="button" tabindex="-1" uk-icon="icon: cloud-upload; ratio: 2"></button>
                            <p>
                                <center style="width:400px; margin-left:-140px;">Clique aqui para adicionar imagem</center>
                            </p>
                        </div>

                    </div>
                </div>
                <div class="col-md-9">
                    <div class="uk-width-1-1">
                        <label class="uk-form-label" for="form-stacked-text">Nome</label>
                        <input class="uk-input form-control" type="text" name="nome" id="validationCustom01" placeholder="Nome" Required autocomplete="of">
                        <div class="valid-feedback">
                            Tudo certo!
                        </div>
                    </div>

                    <div class="uk-width-1-1">
                        <label class="uk-form-label" for="form-stacked-text">CPF</label>
                        <input class="uk-input form-control" type="text" name="cpf" id="validationCustom02" placeholder="CPF" Required>
                        <div class="valid-feedback">
                            Tudo certo!
                        </div>
                    </div>

                    <div class="uk-width-1-1">
                        <label class="uk-form-label" for="form-stacked-text">Email</label>
                        <input class="uk-input form-control" type="email" name="usuario" id="validationCustom03" placeholder="Email" Required>
                        <div class="valid-feedback">
                            Tudo certo!
                        </div>
                    </div>

                    <div class="uk-width-1-1">
                        <label class="uk-form-label" for="form-stacked-text">Senha</label>
                        <input class="uk-input form-control" type="number" name="senha" id="validationCustom04" placeholder="Senha" Required>
                        <div class="valid-feedback">
                            Tudo certo!
                        </div>
                    </div>

                    <div class="uk-width-1-21">
                        <label class="uk-form-label" for="form-stacked-text">Setor</label>
                        <div class="uk-form-controls">
                            <select class="uk-select form-control" name="nivel" id="validationCustom01" id="form-horizontal-select" Required>
                                <option></option>
                                <option>Bloqueador</option>
                                <option>Estoque</option>
                                <option>Compras</option>
                                <option>Operações</option>
                            </select>
                            <div class="valid-feedback">
                                Tudo certo!
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="uk-width-1-1">
                        <button class="uk-button uk-button-secondary" name="salvar">Submit</button>

                    </div>
                </div>

            </form>
            <script>
                // Exemplo de JavaScript inicial para desativar envios de formulário, se houver campos inválidos.
                (function() {
                    'use strict';
                    window.addEventListener('load', function() {
                        // Pega todos os formulários que nós queremos aplicar estilos de validação Bootstrap personalizados.
                        var forms = document.getElementsByClassName('needs-validation');
                        // Faz um loop neles e evita o envio
                        var validation = Array.prototype.filter.call(forms, function(form) {
                            form.addEventListener('submit', function(event) {
                                if (form.checkValidity() === false) {
                                    event.preventDefault();
                                    event.stopPropagation();
                                }

                                form.classList.add('was-validated');
                            }, false);
                        });
                    }, false);
                })();
            </script>
            <!--cadastro-->
            <?php
            if (isset($_POST['salvar'])) {
                $caminho = 'img/perfil/' . $_FILES['img']['name'];
                $nome = $_FILES['img']['name'];
                $nome_temp = $_FILES['img']['tmp_name'];
                move_uploaded_file($nome_temp, $caminho);

                $nome = $_POST['nome'];
                $cpf = $_POST['cpf'];
                $usuario = $_POST['usuario'];
                $senha = $_POST['senha'];
                $nivel = $_POST['nivel'];
                $img = $_FILES['img']['name'];
                @$id = $_POST['id'];

                //verifica se usuario já está cadastrado
                $query_verificar_cpf = "SELECT * FROM usuarios   where cpf = '$cpf' ";
                $result_verificar_cpf = mysqli_query($conexao, $query_verificar_cpf);
                $row_verificar_cpf = mysqli_num_rows($result_verificar_cpf);

                if ($row_verificar_cpf > 0) {

            ?>
                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            $('#my-id').modal('show');
                        });
                    </script>

                    <?php

                }
                if ($img == '') {
                    $query = "INSERT INTO usuarios (nome, cpf, usuario, senha, img, nivel, data) values ('$nome', '$cpf', '$usuario', '$senha', 'user.jpg','$nivel', curDate())";

                    $result = mysqli_query($conexao, $query);
                } else {
                    $query = "INSERT INTO usuarios (nome, cpf, usuario, senha, img, nivel, data) values ('$nome', '$cpf', '$usuario', '$senha', '$img','$nivel', curDate())";

                    $result = mysqli_query($conexao, $query);

                    if ($result == '') {
                        echo "<script language='javascript'>window.alert('ocorreu um erro ao salvar!'); </script>";
                    } else {

                    ?>

                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                $('#my-id2').modal('show');
                            });
                        </script>

            <?php

                    }
                }
            }
            ?>




        </div>

    </li>




    <li>

        <div id="modal-sections" uk-modal style="margin-top: 80px; ">
            <div class="uk-modal-dialog">
                <button class="uk-modal-close-default" type="button" uk-close></button>
                <div class="uk-modal-header">
                    <h2 class="uk-modal-title">Enviar Mensagem</h2>
                </div>
                <div class="uk-modal-body">
                    <form method="POST">
                        <fieldset class="uk-fieldset">


                            <div class="uk-margin">

                            </div>

                            <div class="uk-margin">
                                <select class="uk-select" name="usuario">
                                    <option selected>Escolha pra quem deseja enviar</option>
                                    <?php
                                    $result_niveis_acessos = "SELECT * FROM usuarios";
                                    $resultado_niveis_acesso = mysqli_query($conexao, $result_niveis_acessos);
                                    while ($row_niveis_acessos = mysqli_fetch_assoc($resultado_niveis_acesso)) { ?>
                                        <option id="valor" value="<?php echo $row_niveis_acessos['usuario']; ?>"><?php echo $row_niveis_acessos['usuario'];
                                                                                                                    ?></option> <?php
                                                                                                                            }
                                                                                                                                ?>
                                </select>
                            </div>

                            <div class="uk-margin">
                                <textarea class="uk-textarea" rows="5" placeholder="Textarea" name="assunto"></textarea>
                            </div>
                            <div class="uk-modal-footer uk-text-right">
                                <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
                                <button class="uk-button uk-button-primary" type="submit" name="salvarm">Save</button>
                            </div>
                            <?php
                            if (isset($_POST['salvarm'])) {

                                $usuario = $_SESSION['nome_usuario'];
                                $assunto = $_POST['assunto'];
                                $nivel =  $_SESSION['nivel_usuario'];

                                $img = $_SESSION['img'];


                                $querym = "INSERT INTO notifica (Assunto, nome_enviou, quantidade, nivel, img) values ('$assunto', '$usuario', '0','$nivel', '$img')";
                                $resultm = mysqli_query($conexao, $querym);


                                if ($resultm == '') {
                                    echo "<script language='javascript'>window.alert('ocorreu um erro ao salvar!'); </script>";
                                } else {
                                    echo "<script language='javascript'>window.alert('Salvo!'); </script>";
                                }
                            }


                            ?>

                        </fieldset>
                    </form>
                </div>

            </div>
        </div>
        <div class="cont">
            <main role="main" class="col-md-12 ml-sm-auto col-lg-12 px-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">

                    <div class="btn-toolbar mb-2 mb-md-0">
                        <button class="btn btn-sm btn-outline-secondary" href="#modal-sections" uk-toggle>Enviar mensagem</button>

                    </div>
                </div>
                <?php
                if (isset($_POST["pesquisa"])  != '') {
                } else {
                    $query = "SELECT * from notifica order by id desc limit 40";
                    $query_count = "SELECT * from notifica ";
                    $result_count = mysqli_query($conexao, $query_count);
                }

                $result = mysqli_query($conexao, $query);
                $linha = mysqli_num_rows($result);
                @$linha_count1 = mysqli_num_rows($result_count);

                if ($linha == '') {
                    echo "<h3>Não foram encontrados dados cadastrados no banco</h3>";
                } else {
                ?>
                    <table class="uk-table uk-table-striped uk-box-shadow-medium resultado" style="font-size:12px;">
                        <thead>
                            <tr>


                                <th>Imagem</th>
                                <th>Nome</th>
                                <th>Assunto</th>



                                <?php
                                while ($res = mysqli_fetch_array($result)) {

                                    $Assunto = $res["Assunto"];
                                    $nome_enviou = $res["nome_enviou"];
                                    $nivel = $res["nivel"];
                                    $img = $res["img"];


                                ?>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>



        </div>




        <td><img class="uk-preserve-width uk-border-circle" src="img/Perfil/<?php echo $img; ?>" width="40" alt=""></td>
        <td><?php echo $nome_enviou;  ?> </td>
        <td><?php echo $Assunto; ?></td>


        </td>
        </tr>




    <?php

                                }
    ?>


    </tr>

    </tr>

    <tfoot>
        <tr><span class="text-muted">
                <td colspan="7" align="right">Registro:<?php echo $linha ?></td>
            </span></tr>
    </tfoot>
    </tbody>
    </table>


<?php
                }
?>


</div>


    </li>




    </ul>

    </div>

    <div class="modal fade" id="my-id" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    CPF Já cadastrado ou Campos

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="my-id2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Salvo com sucesso

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>

                </div>
            </div>
        </div>
    </div>
    <!--EXCLUIR -->
    <?php
    if (@$_GET['func'] == 'excluir') {
        $id = $_GET['id'];



        //recuperar cpf do usuário
        $query_cpf = "select * from usuarios where id = '$id' ";
        $result_cpf = mysqli_query($conexao, $query_cpf);

        while ($res = mysqli_fetch_array($result_cpf)) {

            $cpf = $res["cpf"];
            $nivel = $res["nivel"];



            //exclusao dos alunos
            if ($nivel == 'Aluno') {
                $query_alunos = "DELETE FROM alunos where cpf = '$cpf' ";

                $result_alunos = mysqli_query($conexao, $query_alunos);
            }
        }



        $query = "DELETE FROM usuarios where id = '$id' ";
        $result = mysqli_query($conexao, $query);
        echo "<script language='javascript'>window.location='paineladm.php?acao=usuarios'; </script>";
    }

    ?>

    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
    <script type="text/javascript" src="personalizado.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.5.4/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.5.4/dist/js/uikit-icons.min.js"></script>
</body>

</html>