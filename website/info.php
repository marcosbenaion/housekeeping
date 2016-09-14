<?php
echo 'rodou';
//Registra Aparelho
//echo exec('sudo python /var/www/html/register.py tv 0.3');
$nome_aparelho = $_POST['nomeAparelho'];
$kwh_aparelho = $_POST['kwhAparelho'];
$adicionarAparelho = "sudo python /var/www/html/housekeeping/website/register.py {$nome_aparelho} {$kwh_aparelho}";
echo $adicionarAparelho;
//Liga e comeca a monitorar o aparelho
exec($adicionarAparelho);
$listarAparelhos = "sudo python /var/www/html/housekeeping/website/list.py";
exec($listarAparelhos);
//exec('sudo monitor.py tv &');
//exec('irsend SEND_ONCE TV KEY_POWER');

//echo shell_exec('sudo python /var/www/html/turnon.py garrafa && sleep 3 && sudo python /var/www/html/monitor.py garrafa &');
//echo exec('sudo python /var/www/html/turnon.py tv && sleep 3 && monitor.py &');
//echo shell_exec('sudo python /var/www/html/turnon.py garrafa  && sleep 5 && 'sudo python /var/www/html/monitor.py garrafa', $output);
//echo shell_exec('sudo python /var/www/html/monitor.py garrafa 2>&1');
//echo exec('sudo python /var/www/html/shistory.py');
//echo exec('sudo python /var/www/html/shistory.py 2>&1', $output);
//echo exec('sudo python /var/www/html/monitor.py geladeiraLG');
//$cmd = 'sudo python /var/www/html/monitor.py garrafa &';
//$pid = shell_exec($cmd);
//print_r($output);
//print $pid;
function Redirect($url, $permanent = false)
{
    header('Location: ' . $url, true, $permanent ? 301 : 302);

    exit();
}

Redirect('http://housekeeping.local/housekeeping/website/index.html', false);
?>
