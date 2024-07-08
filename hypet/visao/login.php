<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Formulário de Login</title>
</head>
<body>
    <H1 align="center">Acesso aos usuários</H1>
    
     <?php
    
    if (isset($_GET["msg"])) {  // Verifica se tem mensagem de ERRO
        $mensagem = $_GET["msg"];
        echo "<center><FONT color=#DFA100>$mensagem</FONT><center>";
    }
            
        
    
    ?>

    <form method="post" name="formLogin" action="../controlador/back_login.php">
        <table align="center">
            <tr>
                <th>Email</th>
                <td ><input type="text" name="txtLogin" required="" ></td>
            </tr>
            <tr>
                <th>Senha</th>
                <td><input type="password" name="txtSenha" required="" ></td>
            </tr>
            <tr>
                <td><input type="submit" value="Enviar"></td>
                <td><input type="reset" value="Limpar"></td>
            </tr>
        </table>
    </form>
</body>
</html>

