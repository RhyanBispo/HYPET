<?php
session_start();
if (isset( $_SESSION["loginSessao"] )) {
  $nomeSessao = $_SESSION["nomeSessao"];
  $tipoSessao = $_SESSION["tipoSessao"];
  $id_Cliente =  $_SESSION["id_Cliente"];


} else { header("Location:login.php");}
?>

<!DOCTYPE html>

<html lang = "pt-br">
<head>
<link rel="stylesheet" href="estilos.css">
<title>Cadastre seu pet</title>
</head>

<body>

<div id="top">
    <nav id="menu">
        <ul>

            <li>
                <a href="../visao/index_cliente.php">
                    <img src="../imagens/LOGO HYPet.png">
                </a>
            </li>

        </ul>

    </nav>
</div>

<p id="sub1">Venha hospedar seu pet aqui!</p>

<?php
 //Modificar pet
require_once '../modelo/clienteDAO.php';

  if (isset($_GET["varId"]) ){
    $id_Pet = $_GET["varId"];
    require_once '../modelo/conexaobd.php';
    

    $conexao = conectarBD ();
    $resultado = pesquisarPet($conexao, 2, $id_Pet, $id_Cliente);
    if ($registro = mysqli_fetch_assoc($resultado)){
      $nomePet = $registro["nomePet"];
      $dtNascPet = $registro["dtNascPet"];
      $tipoRacao = $registro["tipoRacao"];
      $consDiario = $registro["consDiario"];
      $castrado = $registro["castrado"];
      $sexo = $registro["sexo"];
        
      $CheckMacho = "";
      $CheckFemea = "";
      $CheckCastrado = "";
      $CheckNaoCastrado = ""; 
      
      
      if ($castrado == 'C'){
        $CheckCastrado = "checked";
      }
      if ($castrado == 'N'){
        $CheckNaoCastrado = "checked";
      }
      if ($sexo == 'M'){
        $CheckMacho = "checked";
      }
      if ($sexo == 'F'){
        $CheckFemea = "checked";
      }
    }

  }else {
    $nomePet = "";
    $dtNascPet = "";
    $tipoRacao = "";
    $consDiario = "";
    $castrado = "";

    $CheckMacho = "";
    $CheckFemea = "";
    $CheckCastrado = "";
    $CheckNaoCastrado = "";
  }

?>

<form action="../controlador/back_cadPet.php" method="post" enctype="multipart/form-data" >
    
<input type="hidden" name="idPet" value="<?php echo $id_Pet; ?>">
    
    <table width="100%">

        
        <tr>
          <th width="20%" class="th">Nome do pet</th>
         <td width="80%"><input type="text" name="txtNome"  value="<?php echo $nomePet; ?>" class="td"> </td>
        </tr>

        <tr>
            <th class="th">Data de Nascimento</th>
         <td><input name="txtData" type="date" value="" class="td"></td>
        </tr>

        <tr>
          <th width="20%" class="th">Raça</th>
         <td width="80%"><input type="text" name="txtRaca"  value="" class="td"> </td>
        </tr>

        <tr>
          <th width="20%" class="th">Porte</th>
         <td width="80%"><input type="text" name="txtPorte"  value="" class="td"> </td>
        </tr>

        <tr>
          <th width="20%" class="th">Ração</th>
         <td width="80%"><input type="text" name="txtRacao"  value="<?php echo $tipoRacao; ?>" class="td"> </td>
        </tr>

        <tr>
          <th width="20%" class="th">Consumo diário em g</th>
         <td width="80%"><input type="text" name="txtCons_d"  value="<?php echo $consDiario; ?>" class="td"> </td>
        </tr>
        <tr>
          <td>
            <input id="check1" type="radio" name="rdbUser1" value="M" <?php echo $CheckMacho; ?> /> Macho <BR>
            <input id="check2" type="radio" name="rdbUser1" value="F" <?php echo $CheckFemea; ?> /> Fêmea <BR>
          </td>
        </tr>

        <tr>
          <td>
            <input class="check" id="check3" type="radio" name="rdbUser2" value="C" <?php echo $CheckCastrado; ?> /> Castrado <BR>
            <input class="check" id="check4" type="radio" name="rdbUser2" value="N" <?php echo $CheckNaoCastrado; ?> /> Não Castrado <BR>
          </td>
        </tr>
        <th>Foto</th>
        <td><input name="foto" type="file">
            <img id="imgFoto" name="imgFoto" src="">
          </td>

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
