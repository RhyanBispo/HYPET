<!DOCTYPE html>

<html lang = "pt-br">
<head>
<link rel="stylesheet" href="estilos.css">
<title>HYPet - Cadastre-se</title>
</head>

<body>

<div id="top">
    <nav id="menu">
        <ul>

            <li>
                <a href="../visao/index.php">
                    <img src="../imagens/LOGO HYPet.png">
                </a>
            </li>

        </ul>

    </nav>
</div>

<p id="sub1">Venha hospedar seu pet aqui!</p>

<?php
 //Modificar cliente

    if (isset($_GET["varId"]) ){
        $id_Cliente = $_GET["varId"];
        require_once '../modelo/conexaobd.php';
        require_once '../modelo/clienteDAO.php';
        require_once '../controlador/funcoes.php';
    
        $conexao = conectarBD ();
        $resultado = pesquisarUsuario($conexao, 3, $id_Cliente);
        if ($registro = mysqli_fetch_assoc($resultado)){
            $cpf = $registro["cpf"];
            $nome = $registro["nome"];
            $email = $registro["email"];
            $telefone = $registro["telefone"];
            $dtNasc = $registro["dtNasc"];
            $tipo = $registro["tipo"];


            $CheckUser = "";
            $checkAnfi = "";
            

            if ($tipo == 1){
                $CheckUser = "checked";
            }
            if ($tipo == 2){
                $checkAnfi = "checked";
            }
        }
    }else {
        $id_Cliente = "";
        $cpf = "";
        $nome = "";
        $email = "";
        $telefone = "";
        $dtNasc = "";
        $tipo = "";

        $CheckUser = "";
        $checkAnfi = "";
    }

?>


<form action="../controlador/cadhypet.php" method="post" enctype="multipart/form-data" >
    
    <input type="hidden" name="idCliente" value="<?php echo $id_Cliente; ?>">

    <table width="100%">

        
        <tr>
          <th width="20%" class="th">Nome completo</th>
         <td width="80%"><input type="text" name="txtNome"  value="<?php echo $nome; ?>" class="td"> </td>
        </tr>
        
        <tr>
            <th class="th">CPF</th>
            <td><input name="txtCPF" type="text" maxlength="14" value="<?php echo $cpf; ?>" class="td"> </td>
        </tr>
        
        <tr>
            <th class="th">Email</th>
            <td><input name="txtEmail" type="text"  class="td" value="<?php echo $email; ?>">   </td>
        </tr>
    
        <tr>
            <th class="th">Senha</th>
            <td><input name="txtSenha" type="password" class="td"></td>
        </tr>

        <tr>
            <th class="th">Confirmação da senha</th>
            <td><input name="txtSenha2" type="password" class="td"></td>
        </tr>

        <tr>
          <th class="th">Telefone (apenas números)</th>
          <td> <input name="txtTelefone" type="text" maxlength="12" value="<?php echo $telefone; ?>" class="td"> </td>
        </tr>

        <tr>
            <th class="th">Data de Nascimento</th>
         <td><input name="txtData" type="date" value="<?php echo $dtNasc; ?>" class="td"></td>
        </tr>

        <tr>
          <td>
            <input id="check1" type="radio" name="rdbUser" value="1" <?php echo $CheckUser; ?> /> Usuário <BR>
            <input id="check2" type="radio" name="rdbUser" value="2" <?php echo $checkAnfi; ?> /> Anfitrião
          </td>
        </tr>

        <tr>
          <td>
             <input name="checkTermos" type="checkbox"/>Concordo com os Termos de Uso do HYPet.<BR>
          </td>
        </tr>

        <tr>
          <td><input type="submit" name="btnCadastro" value="Cadastre-se"  class="btn"> </td>
        </tr>

    </table>

</form>


<?php
            // Exibir a mensagem de Cliente cadastrado
            if ( isset( $_GET["msgOK"] ) ) { // Verifica se deu tudo certo
                $mensagem = $_GET["msgOK"];
                echo "<FONT color=#DFA100>$mensagem</FONT>";
            }
            // Exibir a mensagem de ERRO caso OCORRA
            if (isset($_GET["msg"])) {  // Verifica se tem mensagem de ERRO
                $mensagem = $_GET["msg"];
                echo "<FONT color=#DFA100>$mensagem</FONT>";
            }
?>

</body>
</html>