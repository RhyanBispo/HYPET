<!DOCTYPE html>
<html
    <?php
        session_start();
        if (isset( $_SESSION["loginSessao"] )) {
        $nomeSessao = $_SESSION["nomeSessao"];
        $tipoSessao = $_SESSION["tipoSessao"];
        $id_Cliente =  $_SESSION["id_Cliente"];
        } else { header("Location:login.php");}
    ?>

    
    <!--//Buscar pet-->
    
    <form method = "POST" action= "perfil.php">
        <select name= "cmbEscolha">
            <option value = "1">Nome Pet</option>
        </select>
        <input type="text" name="txtPesquisar">
        <input type="submit" name="btnPesq3" value="Pesquisar">
    </form>

    <?php
        
        if ( isset($_POST["btnPesq3"])) {

            require_once '../modelo/conexaobd.php';
            require_once '../modelo/clienteDAO.php';
            
            
            $tipo4 = $_POST["cmbEscolha"];
            $pesq4 = $_POST["txtPesquisar"];
            $conexao = conectarBD();
            $resultado = pesquisarPet($conexao, $tipo4, $pesq4, $id_Cliente);

            //Mostrar os dados
            if ( mysqli_num_rows($resultado) > 0 ) {
                echo "<TABLE border=1>";
                echo "<TR><TH>ID</TH><TH>NOME</TH><TH>Data Nascimento</TH><TH>Raça</TH><TH>EXCLUIR</TH><TH>EDITAR</TH></TR>";
                while ($registro = mysqli_fetch_assoc($resultado)){
                    $id_Pet = $registro["idPet"];
                    $nome_Pet = $registro["nomePet"];
                    $dt_nasc_pet = $registro["dtNascPet"];
                    $racaPet= $registro["raca"];

                    echo "<TR>";
                    echo "<TD>$id_Pet</TD>";
                    echo "<TD>$nome_Pet</TD>";
                    echo "<TD>$dt_nasc_pet</TD>";
                    echo "<TD>$racaPet</TD>";                              
                    echo "<TD><A href='../controlador/excluirPet.php?varId=$id_Pet'> <IMG src='../imagens/remover.png' height='40' width='40'> </A> </TD>";
                    echo "<TD><A href='../visao/cadPet.php?varId=$id_Pet'> <IMG src='../imagens/editar.png' height='40' width='40'> </A> </TD>";
                    echo "</TR>";
                }
                echo "</TABLE>";
            } else {
                echo "Não encontrado nenhum registro.";
            }

            

        }
    ?>       
    <body>
        <form method="POST" action="perfil.php">
            <select name="cmbEscolha">
                <option value="1"></option> 
            </select>
            <input type="text" name="txtPesquisar">
            <input type="submit" name="btnPesq" value="Pesquisar">
        </form>
    </body>
    <?php
        
        if ( isset($_POST["btnPesq"])) {

            require_once '../modelo/conexaobd.php';
            require_once '../modelo/clienteDAO.php';
            
        
            $tipo = $_POST["cmbEscolha"];
            $pesq = $_POST["txtPesquisar"];
            $conexao = conectarBD();
            $resultado = pesquisarReservasCliente($conexao, $id_Cliente);

            //Mostrar os dados
            if ( mysqli_num_rows($resultado) > 0 ) {
                echo "<TABLE border=1>";
                echo "<TR><TH>ID</TH><TH>Data de inicio</TH><TH>Data de saida</TH><TH>PREÇO</TH><TH>EXCLUIR</TH></TR>";
                while ($registro = mysqli_fetch_assoc($resultado)){
                    $nomeHosp= $registro["valorTotal"];
                    $preco= $registro["valorTotal"];
                    $id_Reserva = $registro["idReserva"];
                    $dtInicio = $registro["dataInicio"];
                    $dtSaida= $registro["dataSaida"];
                    $valorTotal = $registro["valorTotal"];
                    

                    echo "<TR>";
                    echo "<TD>$id_Reserva</TD>";
                    echo "<TD>$dtInicio</TD>";
                    echo "<TD>$dtSaida</TD>";    
                    echo "<TD>$valorTotal</TD>";    

                    echo "<TD><A href='../controlador/excluirReserva.php?varId=$id_Reserva'> <IMG src='../imagens/remover.png' height='40' width='40'> </A> </TD>";
                    echo "</TR>";
                }
                echo "</TABLE>";
            } else {
                echo "Não encontrado nenhum registro.";
            }

            

        }
    ?>       



</html>

