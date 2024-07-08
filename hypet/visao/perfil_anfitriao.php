<?php
    //Buscar hospedagem
   // ?>
   <?php
        session_start();
        if (isset( $_SESSION["loginSessao"] )) {
        $id_Cliente =  $_SESSION["id_Cliente"];
        } else { header("Location:login.php");
        }
    ?>


    <form method = "POST" action= "perfil_anfitriao.php">
        <select name= "cmbEscolha">
            <option value = "1">Bairro</option>
            <option value = "2">Cidade</option>
        </select>
        <input type="text" name="txtPesquisar">
        <input type="submit" name="btnPesq" value="Pesquisar">
    </form>

    <?php
       
        if ( isset($_POST["btnPesq"])) {

            require_once '../modelo/conexaobd.php';
            require_once '../modelo/clienteDAO.php';
            
            
            $tipo = $_POST["cmbEscolha"];
            $pesq = $_POST["txtPesquisar"];
            $conexao = conectarBD();
            $resultado = pesquisarHospedagemAnfitriao($conexao, $tipo, $pesq, $id_Cliente);

            //Mostrar os dados
            if ( mysqli_num_rows($resultado) > 0 ) {
                echo "<TABLE border=1>";
                echo "<TR><TH>ID</TH><TH>Nome</TH><TH>Rua</TH><TH>Bairro</TH><TH>Número</TH><TH>Preço</TH><TH>Descrição</TH><TH>EXCLUIR</TH><TH>EDITAR</TH></TR>";
                while ($registro = mysqli_fetch_assoc($resultado)){
                    $id_hospedagem = $registro["idhospedagem"];
                    $nomeHospedagem = $registro["nomeHosp"];
                    $rua = $registro["rua"];
                    $bairro = $registro["bairro"];
                    $num = $registro["numero"];
                    $preco = $registro["preco"];
                    $desc = $registro["descricao"];

                    echo "<TR>";
                    echo "<TD>$id_hospedagem</TD>";
                    echo "<TD>$nomeHospedagem</TD>";
                    echo "<TD>$rua</TD>";
                    echo "<TD>$bairro</TD>";
                    echo "<TD>$num</TD>";
                    echo "<TD>$preco</TD>";
                    echo "<TD>$desc</TD>";                             
                    echo "<TD><A href='../controlador/excluirHospedagem.php?varId=$id_hospedagem'> <IMG src='../imagens/remover.png' height='40' width='40'> </A> </TD>";
                    echo "<TD><A href='../visao/cadHospedagem.php?varId=$id_hospedagem'> <IMG src='../imagens/editar.png' height='40' width='40'> </A> </TD>";
                    echo "</TR>";
            
                    
                }    
                   echo "</TABLE>";
            } else {
                echo "Não encontrado nenhum registro.";
            }

            

        }

        if ( isset($_POST["btnPesq"])) {

            require_once '../modelo/conexaobd.php';
            require_once '../modelo/clienteDAO.php';
            $conexao = conectarBD();
            $tipo = $_POST["cmbEscolha"];
            $pesq = $_POST["txtPesquisar"];
            

            $resultado = pesquisarReservasHospedagem($conexao, $id_Cliente);

            //Mostrar os dados
            if ( mysqli_num_rows($resultado) > 0 ) {
                echo "<TABLE border=1>";
                echo "<TR><TH>ID</TH><TH>Valor Total</TH><TH>Data de inicio</TH><TH>Data de saida</TH><TH>EXCLUIR</TH></TR>";
                while ($registro = mysqli_fetch_assoc($resultado)){
                    $id_Reserva = $registro["idReserva"];
                    $valorTotal = $registro["valorTotal"];
                    $dtInicio = $registro["dataInicio"];
                    $dtSaida= $registro["dataSaida"];

                    echo "<TR>";
                    echo "<TD>$id_Reserva</TD>";
                    echo "<TD>$valorTotal</TD>";
                    echo "<TD>$dtInicio</TD>";
                    echo "<TD>$dtSaida</TD>";                              
                    echo "<TD><A href='../controlador/excluirReserva.php?varId=$id_Reserva'> <IMG src='../imagens/remover.png' height='40' width='40'> </A> </TD>";
                    echo "</TR>";
                }
                echo "</TABLE>";
            } else {
                echo "Não encontrado nenhum registro.";
            }

            

        }

    ?>
    <body>
        <form method="POST" action="perfil_anfitriao.php">
            <select name="cmbEscolha">
                <option value="1"></option> 
            </select>
            <input type="text" name="txtPesquisar">
            <input type="submit" name="btnPesq" value="Pesquisar">
        </form>
    </body>
    <?php
        // Exibir a mensagem de Hospedagem excluida
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