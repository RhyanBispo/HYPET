<?php

session_start();
if (isset( $_SESSION["loginSessao"] )) {
  $id_Cliente = $_SESSION["id_Cliente"];
}

include_once "../modelo/clienteDAO.php";
include_once "../modelo/conexaobd.php";

$conexao = conectarBD();

$idPet = $_POST["pet"];

$dtInicio = $_POST["txtDataEntre"];
$dtSaida = $_POST["txtDataExit"];
$id_hospedagem = $_POST["idHospedagem"];

$preco = pesquisarPreco($conexao, $id_hospedagem);
$entrada = new DateTime($dtInicio);
$saida = new DateTime($dtSaida);

$intervalo = $entrada->diff($saida);
$valorTotal = $preco * $intervalo->days;
         
    
$inserir = AddReserva($conexao, $valorTotal, $dtInicio, $dtSaida, $idPet, $id_hospedagem);
    
 // enviar resposta
header("Location:../visao/TelaReserva.php?idHospedagem=$id_hospedagem&msgOK=Reserva $inserir Inserida com sucesso.");

?>
