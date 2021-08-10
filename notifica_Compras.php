<?php
session_start();
include_once('painelcompra.php');

if (isset($_POST["pesquisa"])  != '') {
} else {
  $query = "SELECT * from notifica order by id desc limit 10";
  $query_count = "SELECT * from notifica ";
  $result_count = mysqli_query($conexao, $query_count);
}

$result = mysqli_query($conexao, $query);
$linha = mysqli_num_rows($result);
@$linha_count1 = mysqli_num_rows($result_count);

if ($linha == '') {
  echo "";
} else {


  while ($res = mysqli_fetch_array($result)) {

    $Assunto = $res["Assunto"];
    $nome_enviou = $res["nome_enviou"];
    $nivel = $res["nivel"];



    if ($nivel == $_SESSION['nivel_usuario'] && $nome_enviou == $_SESSION['usuario']) {

      $linha =   $linha_count1 - 1;
    }
  }
}
