<?php
// Recebe nome e kwh do aparelho atraves do form da pagina
$nome_aparelho = $_POST['nomeAparelho'];
$kwh_aparelho = $_POST['kwhAparelho'];

// Comando a ser executado para adicionar o aparelho
$adicionarAparelho = "sudo python /var/www/html/housekeeping/website/register.py {$nome_aparelho} {$kwh_aparelho}";
exec($adicionarAparelho);

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
