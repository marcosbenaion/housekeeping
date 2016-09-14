<?php
// Recebe nome do aparelho atraves dos parametros do botao
$nome_aparelho = $_GET['nome_aparelho'];

// Comando a ser executado para desligar o aparelho
$desligaAparelho = "sudo python /var/www/html/housekeeping/website/turnoff.py {$nome_aparelho}";
$sinalInfravermelho = "irsend SEND_ONCE {$nome_aparelho} KEY_POWER";
exec($sinalInfravermelho);
exec($desligaAparelho);

// Comando a ser executado para imprimir um novo arquivo com a lista de aparelhos conectados
$listarAparelhos = "sudo python /var/www/html/housekeeping/website/list.py";
$listarHistorico = "sudo python /var/www/html/housekeeping/website/shistory.py";
exec($listarAparelhos);
exec($listarHistorico);

// Comando para redirecionar o usuario para a pagina principal
function Redirect($url, $permanent = false)
{
	header('Location: ' . $url, true, $permanent ? 301 : 302);

	exit();
}
Redirect('index.html', false);
?>
