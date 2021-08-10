<?php
session_start();
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.5.4/dist/css/uikit.min.css" />
    <!--botstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href=".../arr.css" />
    <!--adicionando a folha de estilo-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.5.4/dist/css/uikit.min.css" />
    <!--botstrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <!--botstrap-->
</head>

<body>

    <!--abertura da Navbar-->
    <nav class="uk-navbar bg-dark uk-navbar-container uk-margin uk-box-shadow-large">
        <!--abertura das divs de posicionamento-->
        <div class="uk-navbar-left">
            <!--inserindo span para abertura do menu-->
            <a class="uk-navbar-toggle" uk-navbar-toggle-icon href="#offcanvas-usage" uk-toggle></a>
        </div>
        <div class="uk-navbar-right">
            <div class="container">
                <h5 style="color:white;"> <a href="logout.php" class="uk-link-reset "><span class="uk-margin-small-right" uk-icon="icon: sign-out; ratio: 1;" style="color:white;"></span>Sair</a></h5>
            </div>
        </div>
        <!--fechamento da Navbar-->
    </nav>
    <div class="container">

        <?php
        include_once('conexao.php');
        if (@$_GET['func'] == 'mais') {
            $arrPost = $_GET['minhaVariavel'];
        }

        if (@$_GET['func'] == 'expedir') {
            $id = $_GET['id'];

            $query = "select * from produtos where id = '$id' ";
            $result = mysqli_query($conexao, $query);

            while ($res = mysqli_fetch_array($result)) {
                $desc = $res["descri"];
                $area = $res["area"];
                $est = $res["inicial"];
                $medida = $res["unidade_medida"];

        ?>
                <?php

                ?>
                <script type='text/javascript'>
                    $(document).ready(function() {
                        $("input[name='valor']").blur(function() {
                            var $quanti = $("input[name='inicial']");

                            $.getJSON('function.php', {
                                valor: $(this).val()
                            }, function(json) {
                                $quanti.val(json.quanti);

                            });
                        });
                    });
                </script>
                <!-- Modal Editar -->

                <div class="container">

                    <h1 class="display-6">Alteração de Dados Cadastrais</h1>

                </div>
                <div class="modal-body">
                    <form method="POST" action="">

                        <div class="form-group">
                            <label for="id_produto">Descrição</label>
                            <input type="text" class="form-control mr-2" name="nome" value="<?php echo $desc; ?>" placeholder="Nome" readonly>
                        </div>


                        <div class="form-group">
                            <label for="fornecedor">Quantidade atual</label>
                            <input type="text" class="form-control mr-2" name="inicial" placeholder="Senha" value="<?php echo $est ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label for="fornecedor">Quantidade a expedir</label>
                            <input type="number" name="numero" class="form-control mr-2" name="inicial" placeholder="Quantidade">
                        </div>





                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-dark mb-3" name="editar">Expedir </button>


                    <a href="painel.php"> <button type="button" class="btn btn-primary mb-3" data-dismiss="modal">Cancelar </button></a>
                    </form>
                </div>
    </div>
    </div>

    <?php



                @$numero = $_POST["numero"];
                $est = $res["inicial"];

                $valor = $est - $numero;

                if (isset($_POST['editar'])) {

                    $est = $_POST['inicial'];


                    if ($res["inicial"] != $est) {
                        //VERIFICAR SE O CPF JÁ ESTÁ CADASTRADO
                        $query_verificar_cpf = "SELECT * from produtos where inicial = '$est' ";
                        $result_verificar_cpf = mysqli_query($conexao, $query_verificar_cpf);
                        $row_verificar_cpf = mysqli_num_rows($result_verificar_cpf);
                        if ($row_verificar_cpf > 0) {
                            echo "<script language='javascript'>window.alert('é preciso alteral a quantidade em estoque'); </script>";
                            exit();
                        }
                    }

                    if ($valor < 0) {
                        $query = "UPDATE produtos SET inicial = '0' where id = '$id' ";

                        $result = mysqli_query($conexao, $query);
                    } else {



                        $query = "UPDATE produtos SET inicial = '$valor' where id = '$id' ";

                        $result = mysqli_query($conexao, $query);
                    }





                    if ($result == '') {
                        echo "<script language='javascript'>window.alert('Ocorreu um erro ao Editar!'); </script>";
                    } else {
                        echo "<script language='javascript'>window.alert('Salvo com Sucesso!'); </script>";
                        echo "<script language='javascript'>window.location='painel.php?acao=usuarios'; </script>";
                    }
                }
            }
        }
        if (@$_GET['func'] == 'adicionar') {
            $id = $_GET['id'];

            $query = "select * from produtos where id = '$id' ";
            $result = mysqli_query($conexao, $query);

            while ($res = mysqli_fetch_array($result)) {
                $desc = $res["descri"];
                $area = $res["area"];
                $est = $res["inicial"];
                $medida = $res["unidade_medida"];

    ?>

    <!-- Modal Editar -->

    <div class="container">

        <h1 class="display-6">Alteração de Dados Cadastrais</h1>

    </div>
    <div class="modal-body">
        <form method="POST" action="">

            <div class="form-group">
                <label for="id_produto">Descrição</label>
                <input type="text" class="form-control mr-2" name="nome" value="<?php echo $desc; ?>" placeholder="Nome" readonly>
            </div>


            <div class="form-group">
                <label for="fornecedor">Quantidade atual</label>
                <input type="text" class="form-control mr-2" name="inicial" placeholder="Senha" value="<?php echo $est ?>" readonly>
            </div>

            <div class="form-group">
                <label for="fornecedor">Quantidade a incluir</label>
                <input type="number" name="numero" class="form-control mr-2" name="inicial" placeholder="Quantidade">
            </div>





    </div>

    <div class="modal-footer">
        <button type="submit" class="btn btn-dark mb-3" name="editar">Adcionar </button>


        <a href="painel.php"> <button type="button" class="btn btn-primary mb-3" data-dismiss="modal">Cancelar </button></a>
        </form>
    </div>
    </div>
    </div>
<?php



                @$numero = $_POST["numero"];
                $est = $res["inicial"];

                $valor = $est + $numero;

                if (isset($_POST['editar'])) {

                    $est = $_POST['inicial'];


                    if ($res["inicial"] != $est) {
                        //VERIFICAR SE O CPF JÁ ESTÁ CADASTRADO
                        $query_verificar_cpf = "SELECT * from produtos where inicial = '$est' ";
                        $result_verificar_cpf = mysqli_query($conexao, $query_verificar_cpf);
                        $row_verificar_cpf = mysqli_num_rows($result_verificar_cpf);
                        if ($row_verificar_cpf > 0) {
                            echo "<script language='javascript'>window.alert('é preciso alteral a quantidade em estoque'); </script>";
                            exit();
                        }
                    }




                    $query = "UPDATE produtos SET inicial = '$valor' where id = '$id' ";

                    $result = mysqli_query($conexao, $query);






                    if ($result == '') {
                        echo "<script language='javascript'>window.alert('Ocorreu um erro ao Editar!'); </script>";
                    } else {
                        echo "<script language='javascript'>window.alert('Salvo com Sucesso!'); </script>";
                        echo "<script language='javascript'>window.location='painel.php?acao=usuarios'; </script>";
                    }
                }
            }
        }

?>




</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>

</body>

</html>