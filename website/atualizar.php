<?php
// Recebe nome antigo do aparelho atraves dos parametros no botao
$nome_antigo = $_GET['nome_antigo'];

// Recebe nome novo e novo kwh do aparelho atraves do form da pagina
$nome_novo = $_POST['nomeNovo'];
$kwh_novo = $_POST['novoKwh'];

// Comando a ser executado para atualizar o aparelho
$atualizaAparelho = "sudo python /var/www/html/housekeeping/website/update.py {$nome_antigo} {$nome_novo} {$kwh_novo}";
exec($atualizaAparelho);

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
