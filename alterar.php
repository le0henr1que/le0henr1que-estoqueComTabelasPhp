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


  <?php
  session_start();
  include_once('conexao.php');
  include_once('verificar_autenticacao.php');
  if ($_SESSION['nivel_usuario'] != 'Administrador') {
    header('Location: login.php');
    exit();
  }
  if (@$_GET['func'] == 'edita') {
    $id = $_GET['id'];

    $query = "select * from usuarios where id = '$id' ";
    $result = mysqli_query($conexao, $query);

    while ($res = mysqli_fetch_array($result)) {


      $nome = $res["nome"];
      $cpf = $res["cpf"];
      $usuario = $res["usuario"];
      $senha = $res["senha"];
      $img = $res['img'];
      $nivel = $res["nivel"];
      $data = $res["data"];

  ?>

      <!-- Modal Editar -->
      <br>
      <br>
      <div class="container">
        <div class="row">
          <div class="col-md-4">

            <form method="POST" action="" novalidate enctype="multipart/form-data">

              <div class="uk-width-1-2">
                <img src="img/perfil/<?php echo $img ?>" class="rounded-circle" width="180">
                <div class="js-upload" uk-form-custom>
                  <input type="file" name="img" multiple value="<?php echo $img ?>">

                  <br>
                  <center>
                    <button class="uk-button uk-button" type="button" tabindex="-1" uk-icon="icon: cloud-upload; ratio: 2"></button>
                    <p>Clique aqui para adicionar imagem
                  </center>
                  </p>
                </div>

              </div>
          </div>
          <div class="col-md-8">
            <div class="form-group">
              <label for="id_produto">Nome</label>
              <input type="text" class="uk-input" name="nome" value="<?php echo $nome ?>" placeholder="Nome" required>
            </div>

            <div class="form-group">
              <label for="id_produto">CPF</label>
              <input type="text" class="uk-input" name="cpf" placeholder="CPF" id="cpf" value="<?php echo $cpf ?>" required>
            </div>

            <div class="form-group">
              <label for="id_produto">Usuário</label>
              <input type="text" class="uk-input" name="usuario" placeholder="Usuário" value="<?php echo $usuario ?>" required>
            </div>

            <div class="form-group">
              <label for="fornecedor">Senha</label>
              <input type="text" class="uk-input" name="senha" placeholder="Senha" value="<?php echo $senha ?>" required>
            </div>



            <button type="submit" class="uk-button uk-button-secondary" name="editar">Salvar </button>


            <a href="paineladm.php"> <button type="button" class="uk-button uk-button-primary" data-dismiss="modal">Cancelar </button></a>
            </form>
          </div>
        </div>
      </div>








  <?php


      if (isset($_POST['editar'])) {
        $caminho = 'img/Perfil/' . $_FILES['img']['name'];
        $nome = $_FILES['img']['name'];
        $nome_temp = $_FILES['img']['tmp_name'];
        move_uploaded_file($nome_temp, $caminho);

        $nome = $_POST['nome'];
        $cpf = $_POST['cpf'];
        $usuario = $_POST['usuario'];
        $senha = $_POST['senha'];
        $img = $_FILES['img']['name'];
        $nivel = $_POST['nivel'];


        if ($res["cpf"] != $cpf) {
          //VERIFICAR SE O CPF JÁ ESTÁ CADASTRADO
          $query_verificar_cpf = "SELECT * from usuarios where cpf = '$cpf' ";
          $result_verificar_cpf = mysqli_query($conexao, $query_verificar_cpf);
          $row_verificar_cpf = mysqli_num_rows($result_verificar_cpf);
          if ($row_verificar_cpf > 0) {
            echo "<script language='javascript'>window.alert('CPF já Cadastrado'); </script>";
            exit();
          }
        }

        if ($res["usuario"] != $usuario) {
          //VERIFICAR SE O USUARIO JÁ ESTÁ CADASTRADO
          $query_verificar_usu = "SELECT * from usuarios where usuario = '$usuario' and nivel = '$nivel' ";
          $result_verificar_usu = mysqli_query($conexao, $query_verificar_usu);
          $row_verificar_usu = mysqli_num_rows($result_verificar_usu);
          if ($row_verificar_usu > 0) {
            echo "<script language='javascript'>window.alert('Usuário já Cadastrado'); </script>";
            exit();
          }
        }
        if ($img == '') {
          $query = "UPDATE usuarios SET nome = '$nome', cpf = '$cpf', usuario = '$usuario', senha = '$senha' where id = '$id' ";

          $result = mysqli_query($conexao, $query);
        } else {
          $query = "UPDATE usuarios SET nome = '$nome', cpf = '$cpf', usuario = '$usuario', senha = '$senha', img = '$img' where id = '$id' ";

          $result = mysqli_query($conexao, $query);
        }




        if ($result == '') {
          echo "<script language='javascript'>window.alert('Ocorreu um erro ao Editar!'); </script>";
        } else {
          echo "<script language='javascript'>window.alert('Salvo com Sucesso!'); </script>";

          echo "<script language='javascript'>window.location='paineladm.php?acao=usuarios'; </script>";
        }
      }
    }
  }

  ?>



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
    echo "<script language='javascript'>window.location='painel_admin.php?acao=usuarios'; </script>";
  }

  ?>





  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

  <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
  <script type="text/javascript" src="personalizado.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/uikit@3.5.4/dist/js/uikit.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/uikit@3.5.4/dist/js/uikit-icons.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>

</body>

</html>