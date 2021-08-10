<?php
include_once("conexao.php");

function retorna($valor, $conexao){
	$result_aluno = "SELECT * FROM produtos WHERE descri = '$valor' LIMIT 1";
	$resultado_aluno = mysqli_query($conexao, $result_aluno);
	if($resultado_aluno->num_rows){
		$row_aluno = mysqli_fetch_assoc($resultado_aluno);
		$valores['inicial'] = $row_aluno['nome_aluno'];
		
	}else{
		$valores['inicial'] = 'quantidade não encontrado';
	}
	return json_encode($valores);
}

if(isset($_GET['valor'])){
	echo retorna($_GET['valor'], $conexao);
}
?>