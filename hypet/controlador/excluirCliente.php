<?php

require_once '../modelo/conexaobd.php';
require_once '../modelo/clienteDAO.php';
require_once '../visao/index.php';

$conexao = conectarBD();
$id_Cliente = $_GET["varId"];
excluirCliente($conexao, $id_Cliente);

header("Location:../visao/index.php?msg=Cliente $id_Cliente exluido com sucesso!!!")

?>