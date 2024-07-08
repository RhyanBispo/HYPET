<?php
session_start();
if (isset( $_SESSION["loginSessao"] )) {
  $nomeSessao = $_SESSION["nomeSessao"];
  $tipoSessao = $_SESSION["tipoSessao"];

} else { header("Location:login.php");}
?>


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
                <a href="../visao/index_anfitriao.php">
                    <img src="../imagens/LOGO HYPet.png">
                </a>
            </li>
            


        </ul>

    </nav>
</div>

<p id="sub1">Cadastre sua hospedagem</p>

<?php
//Modificar cliente

    if (isset($_GET["varId"]) ){
        $id_Hospedagem = $_GET["varId"];
        require_once '../modelo/conexaobd.php';
        require_once '../modelo/clienteDAO.php';
    
        $conexao = conectarBD ();
        $resultado = pesquisarHospedagem($conexao, 3, $id_Hospedagem);
        if ($registro = mysqli_fetch_assoc($resultado)){
            $id_Hospedagem = $registro["idhospedagem"];
            $cep = $registro["cep"];
            $rua = $registro["rua"];
            $numero = $registro["numero"];
            $bairro = $registro["bairro"];
            $cidade = $registro["cidade"];
            $uf = $registro["uf"];
            $descricao = $registro ["descricao"];
            $nomeHospedagem = $_POST["nomeHosp"];
            $preco = $_POST["preco"];

        }
    }else {
        $id_Hospedagem = "";
        $cep = "";
        $rua = "";
        $numero = "";
        $bairro = "";
        $cidade = "";
        $uf = "";
        $descricao = "";
        $nomeHospedagem = "";
        $preco = "";

    }

?>

<form action="../controlador/back_hospedagem.php" method="post" enctype="multipart/form-data" >
    
<input type="hidden" name="idhospedagem" value="<?php echo $id_Hospedagem; ?>">

    <table>

        <tr>
            <th class="th">Nome da Hospedagem</th>
            <td><textarea name="txtNomeHosp" cols="30" rows="4" class="td"><?php echo $nomeHospedagem; ?></textarea>    </td>
        </tr>

        <tr>
          <th  class="th">Cep</th>
         <td><input type="text" name="txtCep"  value="<?php echo $cep; ?>" class="td"> </td>
        </tr>

        <tr>
            <th class="th">Rua</th>
            <td><textarea name="txtRua" cols="30" rows="4" class="td"><?php echo $rua; ?></textarea>    </td>
        </tr>

        <tr>
            <th class="th">Número</th>
            <td><textarea name="txtNum" cols="30" rows="4" class="td"><?php echo $numero; ?></textarea>    </td>
        </tr>

        <tr>
            <th class="th">Bairro</th>
            <td><textarea name="txtBairro" cols="30" rows="4" class="td"><?php echo $bairro; ?></textarea>    </td>
        </tr>

        <tr>
            <th class="th">Cidade</th>
            <td><textarea name="txtCidade" cols="30" rows="4" class="td"><?php echo $cidade; ?></textarea>    </td>
        </tr>

        <tr>
            <th class="th">UF</th>
            <td><input name="txtUF" type="text" value="<?php echo $uf; ?>" class="td"></td>
        </tr>

        <tr>
            <th class="th">Preço (diária)</th>
            <td><textarea name="txtPreco" cols="30" rows="4" class="td"><?php echo $preco; ?></textarea>    </td>
        </tr>

        <tr>
            <th class="th">Descrição</th>
            <td><textarea name="txtObs" cols="30" rows="4" class="td"><?php echo $descricao; ?></textarea>    </td>
        </tr>

        <tr>
        <td><SELECT id="tipoHospedagem" name = "tipoHospedagem">
            <?php
            include_once "../modelo/conexaobd.php";
            $conexao = conectarBD();

            $sql = "SELECT * FROM tipoHospedagem";
            $res = mysqli_query ($conexao, $sql) or die (mysqli_error($conexao));

            while ($registro = mysqli_fetch_assoc($res)){
                $tipo_hospedagem = $registro["idtipoHospedagem"];
                $descricao = $registro ["descricao"];
                
                echo "<OPTION value= '$tipo_hospedagem'>$descricao</OPTION>";
            }
            ?>
        </SELECT></td>
        </tr>
        
        <th>Foto</th>
        
        <td><input name="foto" type="file">
            <img id="imgFoto" name="imgFoto" src="">
        </td>
        
        <tr>
          <td><input type="submit" name="btnCadastro" value="Cadastrar"  class="btn"> </td>
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
