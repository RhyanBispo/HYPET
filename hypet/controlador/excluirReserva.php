<?php

require_once '../modelo/conexaobd.php';
require_once '../modelo/clienteDAO.php';
require_once '../visao/index.php';

$conexao = conectarBD();
$id_Reserva = $_GET["varId"];
excluirReserva($conexao, $id_Reserva);

header("Location:../visao/perfil.php?msg=Reserva exluida com sucesso!!!")

?>