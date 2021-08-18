<!DOCTYPE html>
<html lang="pt-br">
<?php
include_once 'query.php';
// teste versão github
session_start();
if (empty($_SESSION['pagina'])) {
    $_SESSION['pagina'] = "";
}

if (isset($_SERVER['HTTP_REFERER'])) {
    $pegaRef = $_SERVER['HTTP_REFERER'];
}
$explode1 = explode("/", $pegaRef);
$contagem = $explode1[count($explode1) - 2];

if($contagem=="caixa-de-areia"){// ***TRUE***SERVE PARA MANDAR REQUISIÇÃO ****FALSE***** PARA NÃO MANDAR
    $abrirsite=false;
}else{
    $abrirsite = true;
}
$_SESSION['abrirsite'] = $abrirsite;

if ($abrirsite == false) {
    $pegaSite = obterQuery($contagem);
    echo "<hr>MODO TESTE ATIVADO<hr>";
    echo "Nome do site: " . $contagem . " - ";
    echo "ID obtido: " . $pegaSite;
} else {
    $pegaSite = obterQuery($contagem);
}
$_SESSION['pagina'] = $pegaSite;


?>

<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="estilo.css" />   
    <script>      

        function abrirSite1(site) {
            nome = document.getElementById('nome');           
            email = document.getElementById('email');
            celular = document.getElementById('celular');
            if (!nome.value == "" && !email.value == "" && !celular.value == "") {
                tr = false;
                window.open(site);
            }
        }
    </script>
</head>

<body>
    <?php    
    $st = 'https://tincdig.com.br/thanks/?'. $contagem;
    $verificarReq;
    if (isset($_POST['nome'])) {
        $verificarReq = true;
    } else {
        $verificarReq = false;
    }       
    ?>
    

    <form action=json.php method="POST" class="form-style-6" name="form1" id="form1">
        <div>
            <label>Nome: *</label>
            <input type="text" id="nome" name="nome" onkeyup="soNome()" placeholder="Nome Completo" required />
        </div>
        <div>
            <label>E-mail: *</label>
            <input type="email" id="email" name="email" placeholder="email@completo" required />
        </div>
        <div>
            <label>Celular: *</label>
            <input type="text" id="celular" onkeyup="telefone()" maxlength="17" value="" name="celular" placeholder="Número do Celular" required />            
        </div>
        <div>         
            <label>Cpf:</label>            
                <input type="text" id="cpf" onkeyup="cpfCnpj()" maxlength="14" name="cpf" value="" placeholder="Número do cpf"  />
            
        </div>
        <div class="input-group mb-3">
            <label>Renda Familia:R$</label>
            <input type="number" step="any" class="form-control" id="rendaFamiliar" name="rendaFamiliar">
        </div>       
           <div>
            <?php
            if ($verificarReq == false) { ?>             
                    <input type="submit" class="form-style-6" id="submit" onClick="abrirSite1('<?php echo $st ?>')">
        </div>
            <?php
            } else { ?>
    <div>
        <label>Aguarde ...</label>
    </div>
<?php }; ?>
    </form>
    <script>
        function somenteLetra(text){
            return text.replace(/[^a-z A-Z]/g,'');
        }

        function justNumbers(text) {
             var numbers = text.replace(/[^0-9]/g,'');
        return (numbers);
}      

        function soNome(){
            var n = document.getElementById('nome').value;
            n = somenteLetra(n);
            document.getElementById('nome').value=n;
        }

        function cpfCnpj(){
            var pegaTecla=event.keyCode;            
            var tel=document.getElementById('cpf').value;            
            if(pegaTecla==8){
                if(tel.length==4){
                    document.getElementById('cpf').value=tel[0]+tel[1]+tel[2];
                }else if (tel.length==8){
                    document.getElementById('cpf').value=tel[0]+tel[1]+tel[2]+"."+tel[4]+tel[5]+tel[6];
                }else if (tel.length==12){
                    document.getElementById('cpf').value=tel[0]+tel[1]+tel[2]+"."+tel[4]+tel[5]+tel[6]+"."+tel[8]+tel[9]+tel[10];
                }
            }else{                
                tel = justNumbers(tel);
                if(tel.length==0){
                    if(tel==""){
                        document.getElementById('cpf').value="";
                    }
                }               
                if(tel.length==1){ 
                    document.getElementById('cpf').value=tel[0];
                }else if(tel.length==2){
                    document.getElementById('cpf').value=tel[0]+tel[1];
                }else if(tel.length==3){
                    document.getElementById('cpf').value=tel[0]+tel[1]+tel[2];
                }else if(tel.length==4){
                    document.getElementById('cpf').value=tel[0]+tel[1]+tel[2]+"."+tel[3];
                }else if(tel.length==5){
                    document.getElementById('cpf').value=tel[0]+tel[1]+tel[2]+"."+tel[3]+tel[4];
                }else if(tel.length==6){
                    document.getElementById('cpf').value=tel[0]+tel[1]+tel[2]+"."+tel[3]+tel[4]+tel[5];
                }else if(tel.length==7){
                    document.getElementById('cpf').value=tel[0]+tel[1]+tel[2]+"."+tel[3]+tel[4]+tel[5]+"."+tel[6];
                }else if(tel.length==8){
                    document.getElementById('cpf').value=tel[0]+tel[1]+tel[2]+"."+tel[3]+tel[4]+tel[5]+"."+tel[6]+tel[7];
                }else if(tel.length==9){
                    document.getElementById('cpf').value=tel[0]+tel[1]+tel[2]+"."+tel[3]+tel[4]+tel[5]+"."+tel[6]+tel[7]+tel[8];
                }else if(tel.length==10){
                    document.getElementById('cpf').value=tel[0]+tel[1]+tel[2]+"."+tel[3]+tel[4]+tel[5]+"."+tel[6]+tel[7]+tel[8]+"-"+tel[9];
                }else if(tel.length==11){
                    document.getElementById('cpf').value=tel[0]+tel[1]+tel[2]+"."+tel[3]+tel[4]+tel[5]+"."+tel[6]+tel[7]+tel[8]+"-"+tel[9]+tel[10];
                }
               
                
            }// esse else faz parte nocaso não for digitado backSpace

        }        

        function telefone(){           
            var pegaTecla=event.keyCode;            
            var tel=document.getElementById('celular').value;            
            if(pegaTecla==8){
                if(tel.length==1){                   
                    document.getElementById('celular').value="";
                }else if(tel.length==3){                  
                    document.getElementById('celular').value="("+tel[1];                   
                }else if(tel.length==6){
                    document.getElementById('celular').value="("+tel[1]+tel[2]+")"+tel[4];
                }else if(tel.length==13){
                    document.getElementById('celular').value="("+tel[1]+tel[2]+")"+tel[4]+"."+tel[6]+tel[7]+tel[8]+tel[9];
                }

            }else{                                                
            tel = justNumbers(tel);
            if(tel.length==0){
                if(tel==""){
                    document.getElementById('celular').value="";
                }
            }
            if(tel.length==1){               
                document.getElementById('celular').value="("+tel;
            }else if(tel.length==2){                     
                document.getElementById('celular').value="("+tel[0]+tel[1]+")";               
            }else if(tel.length==3){
               document.getElementById('celular').value="("+tel[0]+tel[1]+")"+tel[2]+".";
            }else if(tel.length==4){
                document.getElementById('celular').value="("+tel[0]+tel[1]+")"+tel[2]+"."+tel[3];
            }else if(tel.length==5){
                document.getElementById('celular').value="("+tel[0]+tel[1]+")"+tel[2]+"."+tel[3]+tel[4];
            }else if(tel.length==6){
                document.getElementById('celular').value="("+tel[0]+tel[1]+")"+tel[2]+"."+tel[3]+tel[4]+tel[5];
            }else if(tel.length==7){
                document.getElementById('celular').value="("+tel[0]+tel[1]+")"+tel[2]+"."+tel[3]+tel[4]+tel[5]+tel[6];
            }else if(tel.length==8){
                document.getElementById('celular').value="("+tel[0]+tel[1]+")"+tel[2]+"."+tel[3]+tel[4]+tel[5]+tel[6]+" - "+tel[7];
            }else if(tel.length==9){
                document.getElementById('celular').value="("+tel[0]+tel[1]+")"+tel[2]+"."+tel[3]+tel[4]+tel[5]+tel[6]+" - "+tel[7]+tel[8];
            }else if(tel.length==10){
                document.getElementById('celular').value="("+tel[0]+tel[1]+")"+tel[2]+"."+tel[3]+tel[4]+tel[5]+tel[6]+" - "+tel[7]+tel[8]+tel[9];
            }else if(tel.length==11){
                document.getElementById('celular').value="("+tel[0]+tel[1]+")"+tel[2]+"."+tel[3]+tel[4]+tel[5]+tel[6]+" - "+tel[7]+tel[8]+tel[9]+tel[10];
            }
           
        }
  
    }

        
     </script>   
</body>

</html>
