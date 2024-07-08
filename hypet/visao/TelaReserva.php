<!DOCTYPE html>

<html lang="pt-br">

<head>
    <link rel="stylesheet" href="estilos.css">
    <title>Reservas</title>
    <meta http-equiv=”Content-Type” content=”text/html; charset=utf-8″>
    </meta>
</head>


<li>
                <a href="index_cliente.php">
                    <img src="../imagens/LOGO HYPet.png">
                </a>
</li>
            



<?php
  
session_start();
if (isset( $_SESSION["loginSessao"] )) {
$id_Cliente =  $_SESSION["id_Cliente"];
} else { header("Location:login.php");
}



if (isset($_GET["idHospedagem"])){
    $id_Hospedagem = $_GET["idHospedagem"];
}else{
    $id_Hospedagem = -1;
}

?>
<form action="../controlador/backReserva.php" method="post" enctype="multipart/form-data" >
    
    <input type="hidden" name="idHospedagem" value="<?php echo $id_Hospedagem; ?>">

    <table width="100%">
        <tr>
                <th class="th">Data de Entrada</th>
            <td><input name="txtDataEntre" type="date" value="" class="td"></td>
        </tr>

        <tr>
                <th class="th">Data de Saída</th>
            <td><input name="txtDataExit" type="date" value="" class="td"></td>
        </tr>
     
        <tr>
        <td><SELECT id="pet" name = "pet">
            <?php
            include_once "../modelo/conexaobd.php";
            $conexao = conectarBD();

            $sql = "SELECT * FROM pet WHERE cliente_idCliente = $id_Cliente";
            $res = mysqli_query ($conexao, $sql) or die (mysqli_error($conexao));

            while ($registro = mysqli_fetch_assoc($res)){
                $idPet = $registro["idPet"];
                $nomePet = $registro ["nomePet"];
                
                echo "<OPTION value= '$idPet'>$nomePet</OPTION>";
            }
            ?>
        </SELECT></td>
        </tr>    
    
    </table>

    <tr>
          <td><input type="submit" name="btnReserva" value="Reservar"  class="btn"> </td>
          <td></td>
    </tr>

</form>