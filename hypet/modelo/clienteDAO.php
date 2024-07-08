<?php


function cliente($conexao, $cpf, $nome, $email, $senha1, $telefone, $dtNasc, $tipo){
    $conexao = conectarBD();
    $inserirCliente = "INSERT INTO usuário"
        ."(cpf, nome, email, senha, telefone, dtNasc, tipo) VALUES "
        ."('$cpf', '$nome', '$email','$senha1','$telefone', '$dtNasc', '$tipo')";

    mysqli_query($conexao, $inserirCliente) or die ( mysqli_error($conexao));
    $id = mysqli_insert_id($conexao);
    $msgErro = ("Inserido com sucesso");

    return $id;
}

function hospedagem($conexao, $cep, $rua, $numero, $bairro, $cidade, $uf, $descricao, $id_Cliente, $tp_residencia, $nomeHospedagem, $preco, $arquivoH ){
    $conexao = conectarBD();
    
    $tamanhoImg = $arquivoH["size"]; 
    $arqAberto = fopen ( $arquivoH["tmp_name"], "r" );
    $fotoH = addslashes( fread ( $arqAberto , $tamanhoImg ) );
    

    $inserirHospedagem = "INSERT INTO hospedagem"
        ."(cep, rua, numero, bairro, cidade, uf, descricao, usuário_idCliente, tipoHospedagem_idtipoHospedagem, nomeHosp, preco, foto) VALUES "
        ."('$cep', '$rua', $numero, '$bairro', '$cidade', '$uf', '$descricao', $id_Cliente, $tp_residencia, '$nomeHospedagem', $preco, '$fotoH')";
    mysqli_query($conexao, $inserirHospedagem) or die ( mysqli_error($conexao));
    $id = mysqli_insert_id($conexao);
    $msgErro = ("Inserido com sucesso");

    return $id;
}

function pesquisarHospedagemAnfitriao($conexao, $tipo, $pesq, $id_Cliente){

    switch ($tipo){
        case 1: $sql = "SELECT * FROM hospedagem WHERE usuário_idCliente = $id_Cliente and bairro LIKE '$pesq%' " ;
            break;
        case 2: $sql = "SELECT * FROM hospedagem WHERE usuário_idCliente = $id_Cliente and cidade LIKE '$pesq%' " ;
            break;
        case 3: $sql = "SELECT * FROM hospedagem WHERE usuário_idCliente = $id_Cliente and idhospedagem = $pesq " ;
            break;

    }

    
    $res = mysqli_query($conexao, $sql) or die ( mysqli_error($conexao));
    return $res;
}
function pesquisarHospedagem($conexao, $tipo, $pesq){

    switch ($tipo){
        case 1: $sql = "SELECT * FROM hospedagem WHERE bairro LIKE '$pesq%' " ;
            break;
        case 2: $sql = "SELECT * FROM hospedagem WHERE cidade LIKE '$pesq%' " ;
            break;
        case 3: $sql = "SELECT * FROM hospedagem WHERE idhospedagem = $pesq " ;
            break;

    }

    
    $res = mysqli_query($conexao, $sql) or die ( mysqli_error($conexao));
    return $res;
}



function pesquisarUsuario($conexao, $tipo, $pesq, $id_Cliente){
    switch ($tipo){

        case 1: $sql = "SELECT * FROM usuário WHERE idCliente = $id_Cliente and nome LIKE '$pesq%' " ;
            break;
        case 2: $sql = "SELECT * FROM usuário WHERE idCliente = $id_Cliente and cpf LIKE '$pesq%' " ;
            break;
        case 3: $sql = "SELECT * FROM usuário WHERE idCliente = $id_Cliente and idCliente = $pesq " ;
            break;

    }

    $res = mysqli_query($conexao, $sql) or die ( mysqli_error($conexao));
    return $res;

}

//pesquisar pet
function pesquisarPet($conexao, $tipo, $pesq, $id_Cliente){
    switch ($tipo){

        case 1: $sql = "SELECT * FROM pet WHERE cliente_idCliente = $id_Cliente and nomePet LIKE '$pesq%' " ;
            break;
        case 2: $sql = "SELECT * FROM pet WHERE cliente_idCliente = $id_Cliente and idPet = $pesq " ;
            break;
    }

    $res = mysqli_query($conexao, $sql) or die ( mysqli_error($conexao));
    return $res;
}

//pesquisar reserva
function pesquisarReserva($conexao, $tipo, $pesq){
    switch ($tipo){

        case 1: $sql = "SELECT * FROM reserva WHERE idReserva LIKE '$pesq'% " ;
            break;
    }

    $res = mysqli_query($conexao, $sql) or die ( mysqli_error($conexao));
    return $res;
}

//cadastro de pet
function cadpet($conexao, $nomePet, $dt_nasc_p, $raca, $porte, $racao, $cons_d, $sexo, $castrado, $id_Cliente, $arquivo){
    $conexao = conectarBD();
    $tamanhoImg = $arquivo["size"]; 
    $arqAberto = fopen ( $arquivo["tmp_name"], "r" );
    $foto = addslashes( fread ( $arqAberto , $tamanhoImg ) );

    $inserirpet = "INSERT INTO pet"
        ."(nomePet, dtNascPet, raca, Porte, tipoRacao, consDiario, sexo, castrado, foto, cliente_idCliente) VALUES "
        ."('$nomePet', '$dt_nasc_p', '$raca', '$porte', '$racao', '$cons_d', '$sexo', '$castrado', '$foto', $id_Cliente)";
    mysqli_query($conexao, $inserirpet) or die ( mysqli_error($conexao));
    $id = mysqli_insert_id($conexao);
    $msgErro = ("Inserido com sucesso");

    return $id;
}


function excluirCliente($conexao, $id_Cliente){
    $sql = "DELETE FROM usuário WHERE idCliente = $id_Cliente";
    mysqli_query($conexao, $sql) or die (mysqli_error($conexao));

}


function excluirHospedagem($conexao, $id_Hospedagem){
    $sql = "DELETE FROM hospedagem WHERE idhospedagem = $id_Hospedagem";
    mysqli_query($conexao, $sql) or die (mysqli_error($conexao));


}

function excluirPet($conexao, $id_Pet){
    $sql = "DELETE FROM pet WHERE idPet = $id_Pet";
    mysqli_query($conexao, $sql) or die (mysqli_error($conexao));
}

function excluirReserva($conexao, $id_Reserva){
    $sql = "DELETE FROM reserva WHERE idReserva = $id_Reserva";
    mysqli_query($conexao, $sql) or die (mysqli_error($conexao));
}

                         
function alterarcliente($conexao, $id_Cliente ,$cpf, $nome, $email,  $telefone, $dtNasc, $tipo3){
    $sql = "UPDATE usuário SET "
        ."cpf = '$cpf', "
        ."nome = '$nome', "
        ."email = '$email', "
        ."dtNasc = '$dtNasc', "
        ."tipo = '$tipo3', "
        ."telefone = '$telefone' "
        ." WHERE idCliente = $id_Cliente";

    mysqli_query($conexao, $sql) or die ( mysqli_error($conexao) . $sql);
    return $id_Cliente;

}

function validarLogin($conexao, $login, $senha) {

   $sql = "SELECT * FROM usuário WHERE email = '$login'
   AND senha = '$senha' ";
   $res = mysqli_query($conexao, $sql);
   $registro = mysqli_fetch_assoc($res);
   return $registro;

}


function alterarHospedagem($conexao, $id_Hospedagem, $cep, $rua, $numero, $bairro, $cidade, $uf, $descricao, $id_Cliente, $tp_residencia, $nomeHospedagem, $preco){
    $sql = "UPDATE hospedagem SET "
        ."usuário_idCliente = $id_Cliente,"
        ."cep = '$cep', "
        ."rua = '$rua', "
        ."numero = $numero, "
        ."bairro = '$bairro', "
        ."cidade = '$cidade', "
        ."uf = '$uf', "
        ."descricao = '$descricao' "
        ."nomeHosp = '$nomeHospedagem' "
        ."preco = '$preco' "
       //."       = '$tp_residencia'"
        ." WHERE idhospedagem = $id_Hospedagem";

    mysqli_query($conexao, $sql) or die ( mysqli_error($conexao).$sql);
    return $id_Hospedagem;

}

function alterarPet($conexao, $id_Pet ,$tipoRacao, $nomePet, $cons_d){
    $sql = "UPDATE pet SET"
        ."nomePet = '$nomePet', "
        ."tipoRacao = '$tipoRacao', "
        ."consDiario = $cons_d, "
        ." WHERE idPet = $idPet";

    mysqli_query($conexao, $sql) or die ( mysqli_error($conexao));
    return $id_Pet;

}

function pesquisarPreco($conexao, $id_Hospedagem){
    $sql = "SELECT * FROM hospedagem WHERE idhospedagem = $id_Hospedagem";
    $res = mysqli_query ($conexao, $sql) or die (mysqli_error($conexao));
    $preco = 0;
    if ($registro = mysqli_fetch_assoc($res)){
        $preco = $registro ["preco"];
        
    }
    return $preco;
}



//RESERVA
function pesquisarReservasHospedagem($conexao, $id_Cliente){
    $sql = "SELECT * FROM reserva, hospedagem, usuário WHERE reserva.hospedagem_idhospedagem = hospedagem.idhospedagem AND hospedagem.usuário_idCliente = usuário.idCliente AND usuário_idCliente = $id_Cliente";
    $res = mysqli_query($conexao, $sql);
   return $res;

}

function pesquisarReservasCliente($conexao, $id_Cliente){
    $sql = "SELECT * FROM reserva, pet, usuário WHERE reserva.Pet_idPet = pet.idPet AND pet.cliente_idCliente = usuário.idCliente AND usuário.idCliente = $id_Cliente";
    $res = mysqli_query($conexao, $sql);
   return $res;

}

function AddReserva($conexao, $valorTotal, $dtInicio, $dtSaida, $idPet, $id_hospedagem){
    $conexao = conectarBD();
    $inserirReserva = "INSERT INTO reserva"
        ."(valorTotal, dataInicio, dataSaida, Pet_idPet, hospedagem_idhospedagem) VALUES"
        ."($valorTotal, '$dtInicio', '$dtSaida', $idPet, $id_hospedagem)";
    mysqli_query($conexao, $inserirReserva) or die ( mysqli_error($conexao) . " - " . $sql);
    $id = mysqli_insert_id($conexao);
    $msgErro = ("Inserida com sucesso");
    
    return $id;
}

// pesquisar reservas por hospedagem
//  select * from reserva, hospedagem, usuário where reserva.hospedagem_idhospedagem = hospedagem.idhospedagem 
//        AND hospedagem.usuário_idCliente = usuário.idCliente AND usuário_idCliente = $idClienteLogado


// pesquisar reservas por cliente e pet
//  select * from reserva, pet, usuário where reserva.Pet_idPet = pet.idPet 
//        AND pet.cliente_idCliente = usuário.idCliente AND usuário_idCliente = $idClienteLogado


?>