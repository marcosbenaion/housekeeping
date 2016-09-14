<?php
// Recebe nome e kwh do aparelho atraves do form da pagina
$nome_aparelho = $_GET['nome_aparelho'];

// Comando a ser executado para remover o aparelho
$removeAparelho = "sudo python /var/www/html/housekeeping/website/remove.py {$nome_aparelho}";
exec($removeAparelho);

// Comando a ser executado para imprimir um novo arquivo com a lista de aparelhos conectados
$listarAparelhos = "sudo python /var/www/html/housekeeping/website/list.py";
exec($listarAparelhos);

// Comando para redirecionar o usuario para a pagina principal
function Redirect($url, $permanent = false)
{
	header('Location: ' . $url, true, $permanent ? 301 : 302);

	exit();
}
Redirect('index.html', false);
?>
