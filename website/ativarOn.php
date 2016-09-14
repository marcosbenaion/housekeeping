<?php
// Funcao que executa processos em background
/* An easy way to keep in track of external processes.
* Ever wanted to execute a process in php, but you still wanted to have somewhat controll of the process ? Well.. This is a way of doing it.
* @compability: Linux only. (Windows does not work).
* @author: Peec
*/
class Process{
    private $pid;
    private $command;

    public function __construct($cl=false){
        if ($cl != false){
            $this->command = $cl;
            $this->runCom();
        }
    }
    private function runCom(){
        $command = 'nohup '.$this->command.' > /dev/null 2>&1 & echo $!';
        exec($command ,$op);
        $this->pid = (int)$op[0];
    }

    public function setPid($pid){
        $this->pid = $pid;
    }

    public function getPid(){
        return $this->pid;
    }

    public function status(){
        $command = 'ps -p '.$this->pid;
        exec($command,$op);
        if (!isset($op[1]))return false;
        else return true;
    }

    public function start(){
        if ($this->command != '')$this->runCom();
        else return true;
    }

    public function stop(){
        $command = 'kill '.$this->pid;
        exec($command);
        if ($this->status() == false)return true;
        else return false;
    }
}

// Recebe nome do aparelho atraves dos parametros no botao
$nome_aparelho = $_GET['nome_aparelho'];

// Comando a ser executado para ligar o aparelho
$ligarAparelho = "sudo python /var/www/html/housekeeping/website/turnon.py {$nome_aparelho}";
$sinalInfravermelho = "irsend SEND_ONCE {$nome_aparelho} KEY_POWER";
$listarAparelhos = "sudo python /var/www/html/housekeeping/website/list.py";
//$monitorar = new Process('sudo python /var/www/html/housekeeping/website/monitor.py Som');
exec($sinalInfravermelho);
exec($ligarAparelho);
exec($listarAparelhos);
//ponpen("sudo python /varr/www/html/housekeeping/website/monitor.py {$nome_aparelho}", "r");
exec("sudo python /var/www/html/housekeeping/website/monitor.py {$nome_aparelho} &");
//$monitorar.start();
//    $process.start();
//    if ($process.status()){
//        echo "The process is currently running";
//    }else{
//        echo "The process is not running.";
//    }
//$monitorar.start();
//if ($monitorar.status()){
//        echo "The process is currently running";
//    }else{
//        echo "The process is not running.";
//    }

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
