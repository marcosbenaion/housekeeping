<?php
// Recebe nome do aparelho atraves dos parametros no botao
$nome_aparelho = $_GET['nome_aparelho'];

// Comando a ser executado para ligar/desligar o aparelho
$ativaAparelho = "sudo python /var/www/html/housekeeping/website/turnon.py {$nome_aparelho}";
$sinalInfravermelho = "irsend SEND_ONCE {$nome_aparelho} KEY_POWER";
$monitorar = "sudo python /var/www/html/housekeeping/website/monitor.py {$nome_aparelho} &";
exec($ativaAparelho);
exec($sinalInfravermelho);
exec($monitorar);

// Comando a ser executado para imprimir um novo arquivo com a lista de aparelhos conectados
$listarAparelhos = "sudo python /var/www/html/housekeeping/website/list.py";
exec($listarAparelhos);

// Comando para redirecionar o usuario para a pagina principal
function Redirect($url, $permanent = false)
{
    header('Location: ' . $url, true, $permanent ? 301 : 302);

    exit();
}

Redirect('http://housekeeping.local/housekeeping/website/index.html', false);
?>