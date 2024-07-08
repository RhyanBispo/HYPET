<?php

require_once '../modelo/conexaobd.php';
require_once '../modelo/clienteDAO.php';
require_once '../visao/index.php';

$conexao = conectarBD();
$id_hospedagem = $_GET["varId"];
excluirHospedagem($conexao, $id_hospedagem);


header("Location:../visao/index_anfitriao.php?msg=Hospedagem $id_hospedagem exluida com sucesso!!!")


?>