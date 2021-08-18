<?php
$pegasite = true;
session_start();
$pegasite = $_SESSION['abrirsite'];
function removeE($dt)
{
    $dt = trim($dt); //remove espaço no inicio e fim
    return $dt;
}
function minusculo($dt1)
{
    $dt1 = removeE($dt1);
    $dt1 = strtolower($dt1); //deixa todas as letras minúscula
    return $dt1;
}
function deixarNumero($string)
{
    $string = removeE($string);
    $string = preg_replace("/[^0-9]/", "", $string); //remove tudo, deixando apenas números   
    $string = strval($string);
    return $string;
}
function numeroI($ni)
{
    $ni = intval($ni);
    $ni = removeE($ni);
    $ni = strval($ni);
    return $ni;
}
$podeEnviar = true;



$obtqr = $_SESSION['pagina']; //aqui pega o ID
$nome = removeE($_POST['nome']);
$email = minusculo($_POST['email']);
$celular = deixarNumero($_POST['celular']);
$rendaFamiliar = numeroI($_POST['rendaFamiliar']);

if(strlen($obtqr)>3){
    $obtqr=0;
}

if(strlen($celular)==10){
    $pegaV="";
    for($x = 0;$x < strlen($celular);$x++){
        if($x==2){
            $pegaV .= 9;
            $pegaV .= $celular[$x];
        }else{
            $pegaV .= $celular[$x];
        }
        

    }
    $celular = $pegaV;
}

if(strlen($celular)==11){
    if($celular[2] != 9){
        $celular[2]= 9;
    }
}


$request = [
    'id' => 0,
    'nome' => $nome,
    'cpf' => $_POST['cpf'],
    'email' => $email,
    'celular' => $celular,
    'rendaFamiliar' => $rendaFamiliar,
    'idEmpreendimento' => $obtqr,
    'idOrigem' => "4"
];

if ($pegasite == true) {
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://incdigital-integrationserver.archpelago.com:18092/api/prospects',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode($request),
        CURLOPT_HTTPHEADER => array(
            'Authorization: Basic SW5jRGlnOk1oOGZ6ZnZM',
            'Content-Type: application/json'
        ),
    ));
    $response = curl_exec($curl);
    curl_close($curl);
}

if ($pegasite == true) {
header("Location:https://tincdig.com.br/formulario-enviado/");
}else{?>
    <link rel="stylesheet" href="estilo.css" />
    <form class="form-style-6">
    <div>
        <label>ID: <?php echo $obtqr ?></label>
    </div>
    <div>
        <label>Request <?php print_r($request) ?></label>
    </div>
    <?php    
   }


