<?php
session_start();
if (isset( $_SESSION["loginSessao"] )) {
  $id_Cliente = $_SESSION["id_Cliente"];
}
// PASSO 1 - RECEBER OS DADOS DO FORMULARIO
$id_Hospedagem = $_POST ["idhospedagem"];
$cep = $_POST["txtCep"];
$rua = $_POST["txtRua"];
$numero = $_POST["txtNum"];
$bairro = $_POST["txtBairro"];
$cidade = $_POST["txtCidade"];
$uf = $_POST["txtUF"];
$descricao = $_POST["txtObs"];
$tp_residencia = $_POST["tipoHospedagem"];
$nomeHospedagem = $_POST["txtNomeHosp"];
$preco = $_POST["txtPreco"];
$arquivo = $_FILES["foto"];


require_once '../controlador/funcoes.php';
   
// PASSO 2 - VALIDAR OS DADOS
$msgErro = validarHospedagem($cep, $rua, $numero, $bairro, $cidade, $uf, $descricao, $nomeHospedagem, $preco, $arquivo);

if ( empty($msgErro) ) {            
    
    // CONECTAR
    require_once '../modelo/clienteDAO.php';
    require_once '../modelo/conexaobd.php';
    $conexao = conectarBD();
    
    if( empty($id_Hospedagem)){
    $inserir = hospedagem($conexao, $cep, $rua, $numero, $bairro, $cidade, $uf, $descricao, $id_Cliente, $tp_residencia, $nomeHospedagem, $preco, $arquivo);
    
    
        // enviar resposta
        header("Location:../visao/cadHospedagem.php?msgOK=Hospedagem $inserir Inserida com sucesso.");
    } else{
    $inserir = alterarHospedagem($conexao, $id_Hospedagem, $cep, $rua, $numero, $bairro, $cidade, $uf, $descricao, $id_Cliente, $tp_residencia, $nomeHospedagem, $preco, $arquivo);

        // enviar resposta
        header("Location:../visao/cadHospedagem.php?msgOK=Hospedagem $inserir alterada com sucesso.");
    }
    
} else {
    header("Location:../visao/cadHospedagem.php?msg=$msgErro");
}

?>
