<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

function validarCpfCnpj($valor){
    $validator = Validator::make(
        ['cnpj' => $valor],
        ['cnpj' => 'required|cnpj']
        );
    if ($validator->fails()) {
        return false;
    }    
    return true;
}


function i($array){
    echo "<pre>";
    print_r($array);
    echo "</pre>";
    exit;
}
function dataNfe($data){
    return substr($data,0,10);;
}

//Retorna o IP
function get_ip(){
    $variables = array('REMOTE_ADDR',
        'HTTP_X_FORWARDED_FOR',
        'HTTP_X_FORWARDED',
        'HTTP_FORWARDED_FOR',
        'HTTP_FORWARDED',
        'HTTP_X_COMING_FROM',
        'HTTP_COMING_FROM',
        'HTTP_CLIENT_IP');
    
    $return = 'Unknown';
    
    foreach ($variables as $variable)
    {
        if (isset($_SERVER[$variable])){
            $return.= $_SERVER[$variable]." - ";
        }
    }
    
    return $return;
}

function enviarPostCurl($url, $dados){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $dados);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    
    $result = curl_exec($ch);
    curl_close($ch);
    
    return $result;
}
function enviarPutCurl($url, $dados){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_PUT, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $dados);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    
    $result = curl_exec($ch);
    curl_close($ch);
    
    return $result;
}

function enviarGetCurlSDecode($url){
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $json = curl_exec($ch);
    
    curl_close($ch);
    
    return $json;
}

function enviarGetCurl($url){
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $json = curl_exec($ch);
    
    $resultado = json_decode($json);
    curl_close($ch);
    
    return $resultado;
}

function horaNfe($data){
    return substr($data,11,8);;
}

function sanitizeString($str){
    return preg_replace('{\W}', ' ', preg_replace('{ +}', ' ', strtr(
        utf8_decode(html_entity_decode($str)),
        utf8_decode('ÀÁÃÂÉÊÍÓÕÔÚÜÇÑàáãâéêíóõôúüçñ'),
        'AAAAEEIOOOUUCNaaaaeeiooouucn')));
}

 function getCodUF($uf){
     $estados = [
         '11' => 'RO',
         '12' => 'AC',
         '13' => 'AM',
         '14' => 'RR',
         '15' => 'PA',
         '16' => 'AP',
         '17' => 'TO',
         '21' => 'MA',
         '22' => 'PI',
         '23' => 'CE',
         '24' => 'RN',
         '25' => 'PB',
         '26' => 'PE',
         '27' => 'AL',
         '28' => 'SE',
         '29' => 'BA',
         '31' => 'MG',
         '32' => 'ES',
         '33' => 'RJ',
         '35' => 'SP',
         '41' => 'PR',
         '42' => 'SC',
         '43' => 'RS',
         '50' => 'MS',
         '51' => 'MT',
         '52' => 'GO',
         '53' => 'DF'
     ];
    foreach($estados as $key => $e){
        if($uf == $e) return $key;
    }
}

function dataHoraBr($dataHora){
    
    $r = new Carbon($dataHora);
    return  $r->format('d/m/Y H:i');
}


function verificaValor($val, $excep = false){
    $val = preg_replace('/[^\d\.\,]+/', '', $val);
    // Inteiro
    if (preg_match('/^\d+$/', $val)) {
        $valor = (float) $val;
    } else
        // Float
        if (preg_match('/^\d+\.{1}\d+$/', $val)) {
            $valor = (float) $val;
        } else{
            // Vírgula como separador decimal
            if (preg_match('/^[\d\.]+\,{1}\d+$/', $val)) {
                $valor = (float) str_replace(',','.', str_replace('.', '', $val));
            } else {        // Formato inválido ou em branco
                if($excep)
                    // throw new \Exception('Moeda em formato inválido ou desconhecido.');
                    $valor = 0;
            }
        }
        return $valor;
}

function moedaBr($valor, $simbolo = null, $casasDecimais = 2){
    $valor = verificaValor($valor);
    return ((isset($simbolo) && $simbolo) ? 'R$ ':'').number_format($valor, $casasDecimais, ',', '.');
}

function getFloat($valor, $simbolo = null, $casasDecimais = 2){
    $valor = verificaValor($valor);
    if (isset($casasDecimais))
        return (float) number_format($valor, $casasDecimais,'.','');
    else
        return (float) $valor;
            
}

function moedaEn($valor, $simbolo = null, $casasDecimais = 2){
    $valor = verificaValor($valor);
    return ((isset($simbolo) && $simbolo) ? 'US$ ':'').number_format($valor, $casasDecimais, '.', ',');
}

function tira_mascara($valor){
    return  preg_replace("/\D+/", "", $valor);
}

function objToArray($objeto){
    return is_array($objeto) ? $objeto : (array) $objeto;
}
function hoje(){
    return date("Y-m-d");
}

function agora(){
    return date("H:i:s");
}

function databr($value, $format = 'd/m/Y'){
    return Carbon::parse($value)->format($format);
}

//Transforma data do formato Brasileiro para o Inglês
function dataEn($data){
    $data = extrair_data($data, 0);
    return $data[2] . "-" .$data[1] ."-" .$data[0];
}

function primeiroDiaSemana(){    
    return date('Y-m-d', strtotime("sunday -1 week"));
}

function ultimoDiaSemana(){
    return date('Y-m-d', strtotime("saturday 0 week"));
}

function ultimoDiaMes($data){
    $date = new DateTime($data);
    $date->modify('last day of this month');
    return $date->format('d'); // somente o dia
}
function proximaSemana(){
    return date('Y-m-d', strtotime("sunday 0 week"));
}
/*function dataen($value, $format = 'Y-m-d'){
    return Carbon::parse($value)->format($format);
}*/

function tiraAcento($str){
    $comAcentos = array('à', 'á', 'â', 'ã', 'ä', 'å', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ü', 'ú', 'ÿ', 'À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'O', 'Ù', 'Ü', 'Ú');
    $semAcentos = array('a', 'a', 'a', 'a', 'a', 'a', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'y', 'A', 'A', 'A', 'A', 'A', 'A', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'N', 'O', 'O', 'O', 'O', 'O', '0', 'U', 'U', 'U');
    return str_replace($comAcentos, $semAcentos, $str);
}

function extrair_data($data, $opcao=1){
    //Opção 1-EN 2-BR
    if ($opcao==1){
        $dia = substr($data,8,2);
        $mes = substr($data,5,2);
        $ano = substr($data,0,4);
    }
    else{
        $dia = substr($data,0,2);
        $mes = substr($data,3,2);
        $ano = substr($data,6,4);
    }
    return array($dia,$mes,$ano);
}

function somarData($data, $dias=0, $meses=0, $ano=0, $opcao=1 ){
    $data = extrair_data($data, $opcao);
    $resData2 = date("Y-m-d", mktime(0, 0, 0,$data[1] + $meses,   $data[0] + $dias, $data[2] + $ano));
    return $resData2;
}

function getIDDiaSemana($yyyymmdd){
    $dia = new Carbon($yyyymmdd);
    return $dia->dayOfWeek + 1;
}

function zeroEsquerda($str, $qtde){
    return str_pad($str, $qtde,'0',STR_PAD_LEFT);
}

function slug($str){
    # special accents
    $a = array('À','Á','Â','Ã','Ä','Å','Æ','Ç','È','É','Ê','Ë','Ì','Í','Î','Ï','Ð','Ñ','Ò','Ó','Ô','Õ','Ö','Ø','Ù','Ú','Û','Ü','Ý','ß','à','á','â','ã','ä','å','æ','ç','è','é','ê','ë','ì','í','î','ï','ñ','ò','ó','ô','õ','ö','ø','ù','ú','û','ü','ý','ÿ','A','a','A','a','A','a','C','c','C','c','C','c','C','c','D','d','Ð','d','E','e','E','e','E','e','E','e','E','e','G','g','G','g','G','g','G','g','H','h','H','h','I','i','I','i','I','i','I','i','I','i','?','?','J','j','K','k','L','l','L','l','L','l','?','?','L','l','N','n','N','n','N','n','?','O','o','O','o','O','o','Œ','œ','R','r','R','r','R','r','S','s','S','s','S','s','Š','š','T','t','T','t','T','t','U','u','U','u','U','u','U','u','U','u','U','u','W','w','Y','y','Ÿ','Z','z','Z','z','Ž','ž','?','ƒ','O','o','U','u','A','a','I','i','O','o','U','u','U','u','U','u','U','u','U','u','?','?','?','?','?','?');
    $b = array('A','A','A','A','A','A','AE','C','E','E','E','E','I','I','I','I','D','N','O','O','O','O','O','O','U','U','U','U','Y','s','a','a','a','a','a','a','ae','c','e','e','e','e','i','i','i','i','n','o','o','o','o','o','o','u','u','u','u','y','y','A','a','A','a','A','a','C','c','C','c','C','c','C','c','D','d','D','d','E','e','E','e','E','e','E','e','E','e','G','g','G','g','G','g','G','g','H','h','H','h','I','i','I','i','I','i','I','i','I','i','IJ','ij','J','j','K','k','L','l','L','l','L','l','L','l','l','l','N','n','N','n','N','n','n','O','o','O','o','O','o','OE','oe','R','r','R','r','R','r','S','s','S','s','S','s','S','s','T','t','T','t','T','t','U','u','U','u','U','u','U','u','U','u','U','u','W','w','Y','y','Y','Z','z','Z','z','Z','z','s','f','O','o','U','u','A','a','I','i','O','o','U','u','U','u','U','u','U','u','U','u','A','a','AE','ae','O','o');
    return strtolower(preg_replace(array('/[^a-zA-Z0-9 -]/','/[ -]+/','/^-|-$/'),array('','-',''),str_replace($a,$b,$str)));
}

function getNomeDiaSemana($diaSemana){
    switch ($diaSemana){
        case 0:
            return 'Dom';
        case 1:
            return 'Seg';
        case 2:
            return 'Ter';
        case 3:
            return 'Qua';
        case 4:
            return 'Qui';
        case 5:
            return 'Sex';
        case 6:
            return 'Sab';
        default:
            return null;

    }
}

//função limata caracteres
function limita_caracteres($texto, $limite, $quebra = true){
    $tamanho = strlen($texto);
    if($tamanho <= $limite){ //Verifica se o tamanho do texto é menor ou igual ao limite
        $novo_texto = $texto;
    }else{ // Se o tamanho do texto for maior que o limite
        if($quebra == true){ // Verifica a opção de quebrar o texto
            $novo_texto = trim(substr($texto, 0, $limite))."...";
        }else{ // Se não, corta $texto na última palavra antes do limite
            $ultimo_espaco = strrpos(substr($texto, 0, $limite), " "); // Localiza o útlimo espaço antes de $limite
            $novo_texto = trim(substr($texto, 0, $ultimo_espaco))."..."; // Corta o $texto até a posição localizada
        }
    }
    return $novo_texto; // Retorna o valor formatado
}

function validaArrayHorarios( $vetHorarios, $data ){

    $hoje = new Carbon( date("Y-m-d") );
    $data_ref = new Carbon( $data );

    if ( $hoje->eq( $data_ref ) ) {

        foreach ( $vetHorarios->horario->horas as $hora  ) {

            $hora_banco = Carbon::createFromTimeString( date("Y-m-d ".$hora->hora.":00") );

            $diferenca = $hora_banco->diffInMinutes( now() );
            //numero de minutos necessários para compra no mesmo dia
            $intervalo_minimo = 120;

            if (  now()->gt( $hora_banco ) or ( now()->lt( $hora_banco ) and $diferenca < $intervalo_minimo ) ) {
                $hora->setIndisponivel();
            }
        }

    }
    return $vetHorarios;
}
