<?php

require_once '../controlador/funcoes.php';

// PASSO 1 - RECEBER OS DADOS DO FORMULARIO

$login = $_POST["txtLogin"];
$senha = $_POST["txtSenha"];

// PASSO 2 - VERIFICAR CAMPOS

$msgErro = validarCamposLogin($login, $senha);
if (empty($msgErro)) {

    // CONSULTAR BANCO
    require_once '../modelo/clienteDAO.php';
    require_once '../modelo/conexaobd.php';

    $conexao = conectarBD();
    $registro = validarLogin($conexao, $login, $senha);

    if ($registro != null){

        // ADICIONAR SESSÃO
        $nome = $registro["nome"];
        $tipo = $registro["tipo"];
        $id_Cliente = $registro["idCliente"];

        session_start();
        $_SESSION["loginSessao"] = $login;
        $_SESSION["nomeSessao"] = $nome;
        $_SESSION["tipoSessao"] = $tipo;
        $_SESSION["id_Cliente"]=$id_Cliente;
        $_SESSION["carrinho"] = array ();

        // REDIRECIONAR PARA A PÁGINA PRINCIPAL DE USUÁRIO OU ADMINISTRADOR
        
    
    // 1-Administrador
        if ( $tipo == 1) {
            header("Location:../visao/index_cliente.php");
        }else{
            header("Location:../visao/index_anfitriao.php");
        }
       




    } else {

        header("Location:../visao/login.php?msg=Login/Senha inválidos!"); 
    }







} else {

    header("Location:../visao/login.php?msg=$msgErro");
}














?>