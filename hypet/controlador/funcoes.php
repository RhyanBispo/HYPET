<?php

    
//FUNÇÃO DE DADOS DO USUÁRIO
    function validarDados($cpf, $nome, $email, $senha1, $senha2, $telefone, $dtNasc ) {
    
        $msgErro = "";

        if ( empty($nome) ) {
            $msgErro = $msgErro . "NOME inválido! <BR>";
        }

        if ( empty($cpf) ) {
            $msgErro = $msgErro . "CPF inválido! <BR>";
        }  

        if ( empty($email) ) {
            $msgErro = $msgErro . "EMAIL inválido! <BR>";
        }

        if ( empty($senha1) or $senha1 =! $senha2){
            $msgErro = $msgErro . "SENHA inválida! <BR>";
        }

        if ( empty($telefone)){
            $msgErro = $msgErro . "TELEFONE inválido! <BR>";
        }
        
        
        return $msgErro;        
              
    }

// VALIDA A DATA
    function validarData($dtNasc) {
        $dataSep = explode("/", $dtNasc);
        if ( count($dataSep) != 3 ) {
            return false;
        } else {
            $dia = $dataSep[0];
            $mes = $dataSep[1];
            $ano = $dataSep[2];
            return checkdate($mes, $dia, $ano);
        }
    }

    function converterData($dtNasc){
        if (validarData($dtNasc) ) {
            $dataSep = explode("/", $dtNasc);
            $dia = $dataSep[0];
            $mes = $dataSep[1];
            $ano = $dataSep[2];
            return "$ano-$mes-$dia";
        }else{
            return null;
        }

    }

    function converterDataBanco($dtNasc){
            $dataSep = explode("-", $dtNasc);
            $ano = $dataSep[0];
            $mes = $dataSep[1];
            $dia = $dataSep[2];
            return "$dia/$mes/$ano";
    }

//VALIDAR DATAS RESERVA
//function validarDataEntrada($dtInicio) {
    //$dataSep = explode("/", $dtInicio);
    //if ( count($dataSep) != 3 ) {
        //return false;
    //} else {
        //$dia = $dataSep[0];
        //$mes = $dataSep[1];
        //$ano = $dataSep[2];
        //return checkdate($mes, $dia, $ano);
    //}
//}

//function converterDataEntrada($dtInicio){
    //if (validarData($dtInicio) ) {
        //$dataSep = explode("/", $dtInicio);
        //$dia = $dataSep[0];
        //$mes = $dataSep[1];
        //$ano = $dataSep[2];
        //return "$ano-$mes-$dia";
    //}else{
        //return null;
    //}

//}

//function converterDataBancoEntrada($dtInicio){
        //$dataSep = explode("-", $dtInicio);
        //$ano = $dataSep[0];
        //$mes = $dataSep[1];
        //$dia = $dataSep[2];
        //return "$dia/$mes/$ano";
//}
//function validarDataSaida($dtSaida) {
    //$dataSep = explode("/", $dtSaida);
    //if ( count($dataSep) != 3 ) {
        //return false;
    //} else {
        //$dia = $dataSep[0];
        //$mes = $dataSep[1];
       // $ano = $dataSep[2];
        //return checkdate($mes, $dia, $ano);
   // }
//}

//function converterDataSaida($dtSaida){
    //if (validarData($dtSaida) ) {
       // $dataSep = explode("/", $dtSaida);
      //  $dia = $dataSep[0];
      //  $mes = $dataSep[1];
       // $ano = $dataSep[2];
       // return "$ano-$mes-$dia";
    //}else{
        //return null;
    //}

//}

//function converterDataBancoSaida($dtSaida){
        //$dataSep = explode("-", $dtSaida);
        //$ano = $dataSep[0];
        //$mes = $dataSep[1];
        //$dia = $dataSep[2];
        //return "$dia/$mes/$ano";
//}


//FUNÇÃO DE DADOS DA HOSPEDAGEM
    function validarHospedagem($cep, $rua, $numero, $bairro, $cidade, $uf, $descricao, $arquivoH) {
    
        $msgErro = "";

        if (empty($cep)) {
            $msgErro = $msgErro . "CEP inválido";
            }

        if ( empty($rua) ) {
            $msgErro = $msgErro . "RUA inválida! <BR>";
        }

        if ( empty($numero) ) {
            $msgErro = $msgErro . "NÚMERO inválido! <BR>";
        }

        if ( empty($bairro) ) {
            $msgErro = $msgErro . "BAIRRO inválido! <BR>";
        }  

        if ( empty($cidade) ) {
            $msgErro = $msgErro . "CIDADE inválida! <BR>";
        }

        if ( empty($uf) ) {
            $msgErro = $msgErro . "ESTADO inválido! <BR>";
        }  

        if ( empty($descricao) ) {
            $msgErro = $msgErro . "DESCRIÇÃO inválida! <BR>";
        }
        
        if( $arquivo["error"] != 0 ) {
            $msgErro = $msgErro . "ERRO no upload do arquivo!<BR>";
        }
        
        else if( $arquivo["size"] > 100000   ) {
            $msgErro = $msgErro . "Arquivo muito grande!<BR>";            
        }
/*
        else if( ( $arquivo["type"] != "image/gif") &&
            ( $arquivo["type"] != "image/jpeg") &&
            ( $arquivo["type"] != "image/pjpeg") &&
            ( $arquivo["type"] != "image/png") &&
            ( $arquivo["type"] != "image/x-png") &&
            ( $arquivoH["type"] != "image/bmp")  ) {
            $msgErro = $msgErro . "Tipo não permitido!<BR>";
        }
        */
        return $msgErro;        
              
    }

    function validarpet($nomePet, $dt_nasc_p, $raca, $porte, $racao, $cons_d, $sexo, $castrado, $arquivo){
    
        $msgErro = "";

        if (empty($nomePet)) {
            $msgErro = $msgErro . "Nome inválido";
            }

        if ( empty($dt_nasc_p) ) {
            $msgErro = $msgErro . "DATA inválida! <BR>";
        }

        if ( empty($raca) ) {
            $msgErro = $msgErro . "RAÇA inválido! <BR>";
        }

        if ( empty($porte) ) {
            $msgErro = $msgErro . "PORTE inválido! <BR>";
        }  

        if ( empty($racao) ) {
            $msgErro = $msgErro . "RAÇÃO inválida! <BR>";
        }

        if ( empty($cons_d) ) {
            $msgErro = $msgErro . "CONSUMO inválido! <BR>";
        }
        
        if( $arquivo["error"] != 0 ) {
            $msgErro = $msgErro . "ERRO no upload do arquivo!<BR>";
        }
        
        else if( $arquivo["size"] > 100000   ) {
            $msgErro = $msgErro . "Arquivo muito grande!<BR>";            
        }

        else if( ( $arquivo["type"] != "image/gif") &&
            ( $arquivo["type"] != "image/jpeg") &&
            ( $arquivo["type"] != "image/pjpeg") &&
            ( $arquivo["type"] != "image/png") &&
            ( $arquivo["type"] != "image/x-png") &&
            ( $arquivo["type"] != "image/bmp")  ) {
            $msgErro = $msgErro . "Tipo não permitido!<BR>";
        } 
        
        return $msgErro;        
              
    }

    function validarCamposLogin($login, $senha){

        if ( empty($login) ) {
            $msgErro = $msgErro . "Login inválido! <BR>";
        }

        if ( empty($senha) ) {
            $msgErro = $msgErro . "Senha inválido! <BR>";

        return $msgErro;
    }


    //return $msgErro;
}



//Função que puxa os dados do CEP
// function get_endereco ($cep){

//         $cep = preg_replace("/[^0-9]/", "", $cep);
//         $url = "http://viacep.com.br/ws/$cep/xml/";

//         $xml = simplexml_load_file($url);
//         return $xml;
// }

//     $endereco = (get_endereco("29703173"));

//     echo "CEP:      $endereco->cep <br>";
//     echo "Rua:      $endereco->logradouro <br>" ;
//     echo "Bairro:   $endereco->bairro <br>" ;
//     echo "cidade:   $endereco->localidade <br>" ;
//     echo "UF:       $endereco->uf <br>" ;
//     echo "Número:   $endereco->complemento <br>" ;

?>
