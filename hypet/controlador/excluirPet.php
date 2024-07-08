<?php

require_once '../modelo/conexaobd.php';
require_once '../modelo/clienteDAO.php';
require_once '../visao/index.php';

$conexao = conectarBD();
$id_Pet = $_GET["varId"];
excluirPet($conexao, $id_Pet);


header("Location:../visao/perfil.php?msg=Pet $id_Pet exluido com sucesso!!!")


?>