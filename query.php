<?php
function obterQuery($pg){
    $pegasite = $_SESSION['abrirsite'];    
    include_once 'servidor.php';
    $teste = "O Id do Site ";   
    $recebe = "não encontrado"; 
    if($pegasite == true){
        $sql = "SELECT * FROM empreendimento";
    }else{
        $sql = "SELECT * FROM commDev1";
    }
        
	$resultado = $conn->query($sql);    
    foreach ($resultado as $result){
        if($pg == $result['nome']){
            $recebe = $result['id'];
            $teste ="";           
            break;
        }                 
    }
    if($teste == 'O Id do Site '){
        echo "<hr>";
        echo $teste . $pg . " não foi encontrado, porem Será utlizado ID:0";
        echo "<hr>";
    }
    return $recebe;
}
?>