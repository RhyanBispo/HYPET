<?php

// PASSO 1 - RECEBER OS DADOS DO FORMULARIO
$id_Cliente = $_POST ['idCliente'];
$cpf = $_POST["txtCPF"];
$nome = $_POST["txtNome"];
$email = $_POST["txtEmail"];
$senha1 = $_POST["txtSenha"];
$senha2 = $_POST["txtSenha2"];
$telefone = $_POST["txtTelefone"];
$dtNasc = $_POST["txtData"];
$tipo = $_POST["rdbUser"];



require_once '../controlador/funcoes.php';

// CHECKBOX
$concordo = false;

if ( isset ( $_POST["checkTermos"] ) ){
    $concordo = true;
}
   
// PASSO 2 - VALIDAR OS DADOS
$msgErro = validarDados($cpf, $nome, $email, $senha1, $senha2, $telefone, $dtNasc );

if ( empty($msgErro) ) {            
    
    // CONECTAR
    require_once '../modelo/clienteDAO.php';
    require_once '../modelo/conexaobd.php';
    $conexao = conectarBD();
    
    
    
    
    if( empty($id_Cliente)){
        $inserir = cliente($conexao, $cpf, $nome, $email, $senha1, $telefone, $dtNasc, $tipo);
    
    
        // enviar resposta
        header("Location:../visao/cadUser.php?msgOK=Cliente $inserir Inserido com sucesso.");
    } else{
        $inserir = alterarcliente($conexao, $id_Cliente, $cpf, $nome, $email, $telefone, $dtNasc, $tipo);
    
    
        // enviar resposta
        header("Location:../visao/cadUser.php?msgOK=Cliente $inserir alterado com sucesso.");
    }

} 
else {
    header("Location:../visao/cadUser.php?msg=$msgErro");

}


?>