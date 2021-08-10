<?php
//Incluir a conexão com banco de dados
include_once 'conexao.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<?php

session_start();
include_once('verificar_autenticacao.php');
?>



<head>

    <!--metas-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=devicec-width, intial-scale=1, shrink-to-fit=no">
    <!--deixar inspecionado-->
    <meta name="description" content="Controle de saida estoque T4S">
    <!--descrição que irá aparecer na hora da pesquisa-->
    <meta name="author" content="">
    <!--Autor do site-->
    <meta name="keybords" contents="">
    <!--palavras chaves-->
    <!--liks-->
    <title>Estoque </title>
    <link rel="stylesheet" type="text/css" href=".../arr.css" />
    <!--adicionando a folha de estilo-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.5.4/dist/css/uikit.min.css" />
    <!--botstrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <!--botstrap-->

</head>

<body>
    <?php
    $usuarios = filter_input(INPUT_POST, 'palavra', FILTER_SANITIZE_STRING);
    ?>
    <table class="uk-table uk-table-striped uk-box-shadow-medium" style="font-size:12px;">
        <thead>
            <tr>
                <th></th>
                <th>Imagem</th>
                <th>Descrição</th>
                <th>Área</th>
                <th>Quantidade</th>
                <th>Medida</th>
                <th>Ações</th>
        </thead>
        <?php

        //Pesquisar no banco de dados nome do usuario referente a palavra digitada
        $result_user = "SELECT * FROM produtos WHERE descri LIKE '%$usuarios%' LIMIT 20";
        $resultado_user = mysqli_query($conexao, $result_user);

        if (($resultado_user) and ($resultado_user->num_rows != 0)) {

            while ($row_user = mysqli_fetch_array($resultado_user)) {
        ?>

                <tbody>
                    <tr>
                        <td></td>

                        <td> <img src="img/insumo/<?php echo $row_user['img']; ?>" width="40"></td>
                        <td><?php echo $row_user['descri']; ?></td>
                        <td><?php echo $row_user['area']; ?></td>
                        <td><?php echo $row_user['inicial']; ?></td>
                        <td><?php echo $row_user['unidade_medida']; ?></td>
                        <td>
                            <?php
                            if ($_SESSION['nivel_usuario'] == 'Estoque') {
                            ?>
                                <a href="expedir.php?acao=usuarios&func=adicionar&id=<?php echo $id; ?>"><button type="button" class="btn btn-dark mb-3" style="font-size:12px;">Adicionar</button></a>
                                <a href="expedir.php?acao=produtos&func=expedir&id=<?php echo $id; ?>"><button type="button" class="btn btn-dark mb-3" style="font-size:12px;">Expedir</button></a>
                            <?php
                            }
                            if ($_SESSION['nivel_usuario'] == 'Compras') {
                            ?>
                                <?php
                                $est = $row_user["inicial"];
                                $medida =  $row_user["unidade_medida"];
                                if ($est >= 100 && $est <= 150) {
                                    if ($medida == 'Unidade') {
                                        echo "<div class='alert alert-warning' role='alert'>Rever estoque</div>";
                                    }
                                }
                                if ($est >= 151) {
                                    if ($medida == 'Unidade') {
                                        echo "<div class='alert alert-success' role='alert'>estoque completo</div>";
                                    }
                                }
                                if ($est < 100) {
                                    if ($medida == 'Unidade') {

                                        echo "<div class='alert alert-danger' role='alert'>comprar urgente</div>";
                                    }
                                }





                                if ($est >= 20 && $est <= 35) {
                                    if ($medida == 'Metros') {
                                        echo "<div class='alert alert-warning' role='alert'>Rever estoque</div>";
                                    }
                                }
                                if ($est >= 36) {
                                    if ($medida == 'Metros') {
                                        echo "<div class='alert alert-success' role='alert'>estoque completo</div>";
                                    }
                                }
                                if ($est < 19) {
                                    if ($medida == 'Metros') {
                                        echo "<div class='alert alert-danger' role='alert'>comprar urgente</div>";
                                    }
                                }

                                ?>
                            <?php

                            } else {
                            ?>
                                <a href="alterar.php?acao=usuarios&func=edita2&id=<?php echo $id; ?>" class="uk-icon-link uk-margin-small-right" uk-icon="file-edit"></a>
                                <a href="paineladm.php?acao=usuarios&func=excluir2&id=<?php echo $id; ?>" lass="uk-icon-link" uk-icon="trash"></a>

                            <?php
                            } ?>

                        </td>
                    </tr>
                </tbody>


        <?php

            }
        } else {
            echo "<div class='uk-alert-primary' uk-alert>
    <a class='uk-alert-close' uk-close></a>
    <p><center>Sem Inventário</center></p>
</div>";
        }
        ?>
    </table>
</body>

</html>