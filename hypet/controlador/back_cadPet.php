<?php

session_start();
if (isset( $_SESSION["loginSessao"] )) {
  $id_Cliente = $_SESSION["id_Cliente"];
}

// PASSO 1 - RECEBER OS DADOS DO FORMULARIO
$nomePet = $_POST["txtNome"];
$dt_nasc_p = $_POST["txtData"];
$raca = $_POST["txtRaca"];
$porte = $_POST["txtPorte"];
$racao = $_POST["txtRacao"];
$cons_d = $_POST["txtCons_d"];
$sexo = $_POST["rdbUser1"];
$castrado = $_POST["rdbUser2"];
$arquivo = $_FILES["foto"];




require_once '../controlador/funcoes.php';
require_once '../modelo/clienteDAO.php';
   
// PASSO 2 - VALIDAR OS DADOS
$msgErro = validarpet($nomePet, $dt_nasc_p, $raca, $porte, $racao, $cons_d, $sexo, $castrado, $arquivo);

if ( empty($msgErro) ) {            
    
    // CONECTAR
    require_once '../modelo/clienteDAO.php';
    require_once '../modelo/conexaobd.php';
    $conexao = conectarBD();
    
    $inserir = cadpet($conexao, $nomePet, $dt_nasc_p, $raca, $porte, $racao, $cons_d, $sexo, $castrado, $id_Cliente, $arquivo);
    
    // enviar resposta
    header("Location:../visao/cadPet.php?msgOK=Pet $inserir Inserido com sucesso.");
} else {
    header("Location:../visao/cadPet.php?msg=$msgErro");
}

?>
