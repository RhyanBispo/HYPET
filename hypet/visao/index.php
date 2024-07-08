<!DOCTYPE html>

<html lang="pt-br">

<head>
    <link rel="stylesheet" href="estilos.css">
    <title>HYPet - Home</title>
    <meta http-equiv=”Content-Type” content=”text/html; charset=utf-8″>
    </meta>
</head>

<div id="top">
    <nav id="menu">
        <ul>

            <li>
                <a href="index.php">
                    <img src="../imagens/LOGO HYPet.png">
                </a>
            </li>
            <li>

                <?php
                // SE O USUÁRIO ESTIVER LOGADO, VAI APARECER O NOME DELE NO LUGAR DO BOTÃO DE LOGIN
                session_start();
                if (isset( $_SESSION["loginSessao"] )) {
                    $nomeSessao = $_SESSION["nomeSessao"];
                    echo "<a class='cad' href='perfil.php'>$nomeSessao</a>";

                } else { echo "<a class='cad' href='login.php'>LOGIN</a>";}
                ?>
                <a class="cad" href="cadUser.php">CADASTRE-SE</a>
                
                <a class="cad" href="../controlador/logout.php">LOGOUT</a>
                

                
                
            </li>

        </ul>

    </nav>
</div>

<body>


    <h1>Encontre o melhor lugar para seu pet!</h1>

    <img id="img"src="../imagens/gato.jpg">
    <p class="desc">Avaliação rigorosa de todos os Anfitriões do site</p>
    <p class="desc">Acompanhamento através de Chat com o Anfitrião</p>
    <p class="desc">Pagamento SEGURO por meio da plataforma</p>



    <?php
    //Buscar hospedagem
   // ?>

    <form method = "POST" action= "index.php">
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
            $resultado = pesquisarHospedagem($conexao, $tipo, $pesq);

            //Mostrar os dados
            if ( mysqli_num_rows($resultado) > 0 ) {
                echo "<TABLE border=1>";
                echo "<TR><TH>ID</TH><TH>Nome</TH><TH>Rua</TH><TH>Bairro</TH><TH>Número</TH><TH>Preço</TH><TH>Descrição</TH></TR>";
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
                    //echo "<TD><A href='../controlador/excluirHospedagem.php?varId=$id_hospedagem'> <IMG src='../imagens/remover.png' height='40' width='40'> </A> </TD>";
                   // echo "<TD><A href='../visao/cadHospedagem.php?varId=$id_hospedagem'> <IMG src='../imagens/editar.png' height='40' width='40'> </A> </TD>";
                    echo "</TR>";
            
                    
                }    
                   echo "</TABLE>";
            } else {
                echo "Não encontrado nenhum registro.";
            }

            

        }

    ?>
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


    <?php
        // Exibir a mensagem de cliente excluido
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