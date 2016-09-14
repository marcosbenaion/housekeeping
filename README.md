# Smart Homes - Housekeeping
  Projeto de software apresentado à disciplina de Laboratório de Engenharia de Software da UFPA
  
# Proposta
  Smart Homes, também conhecido como automação de casas, é a mecanização de atividades rotineiras em uma residência através de sistemas 
  computacionais interligados que podem ser controlados por vários terminais diferentes, como controles remotos, sensores e diversos 
  outros dispositivos, com interface para o usuário comum utilizar sem maiores diﬁculdades. 
  
# Material Necessário:
  * Hardware:
    * Sistema Embarcado Raspberry Pi + MicroSD Card 8GB ou mais
    * Protoboard
    * LED Infravermelho Emissor
    * LED Sensor Optico Receptor
    * Transistor 2N 2222
    * 1 Resistor 1/4W
    * 1 Resistor 330 Ohm
  * Software:
    * Raspbian
    * SSH - Para acessar o raspberry através de outro computador na mesma rede
    * LIRC - Para acessar comandos de manipulação de componentes infravermelhos
    * PHP - Para Rodar os scripts em python de acesso ao banco pela web
    * SQlite - Para armazenar dados dos Dispositivos Conectados
    * Nginx - Servidor para hospedar localmente (no raspberry) o site

# Configuração da Protoboard e Conexões no raspberry
  * Imagem Protoboard 1: https://github.com/marcosbenaion/housekeeping/blob/master/imagens/P_20160831_235139_1_p.jpg
  * Imagem Protoboard 1: https://github.com/marcosbenaion/housekeeping/blob/master/imagens/P_20160908_224359.jpg
  * Imagem Conexões no Raspberry: https://github.com/marcosbenaion/housekeeping/blob/master/imagens/P_20160831_235250_1_p.jpg
  
# Instalação e configuração do Software:
  * Baixar imagem do Raspbian - http://www.raspberrypi.org/downloads
  * Descompactar e Instalar raspbian no MicroSD Card - http://elinux.org/RPi_Easy_SD_Card_Setup
  * Atualizar o sistema operacional
    * sudo apt-get update
    * sudo apt-get upgrade
    * sudo apt-get dist-upgrade
  * Atualizar Firmware
    * sudo apt-get install git-core
    * sudo wget http://goo.gl/1BOfJ -O /usr/bin/rpi-update && sudo chmod +x /usr/bin/rpi-update
    * sudo rpi-update
    * (créditos: http://alexba.in/blog/2013/01/04/raspberrypi-quickstart/)
  * Instalar LIRC
    * sudo apt-get install lirc
    * Configurar arquivo /etc/modules - https://github.com/marcosbenaion/housekeeping/blob/master/arquivosConfiguracao/modules
    * Configurar arquivo /etc/lirc/hardware.conf - https://github.com/marcosbenaion/housekeeping/blob/master/arquivosConfiguracao/hardware.conf
    * Reiniciar LIRC - sudo /etc/init.d/lirc stop e sudo /etc/init.d/lirc start
    * Configurar arquivo /boot/config.txt - https://github.com/marcosbenaion/housekeeping/blob/master/arquivosConfiguracao/config.txt
    * (Adicional) Testar Receptor Infravermelho / Emissor Infravermelho e LIRC - http://alexba.in/blog/2013/01/06/setting-up-lirc-on-the-raspberrypi/
    * (créditos: http://alexba.in/blog/2013/01/06/setting-up-lirc-on-the-raspberrypi/)
  * (Opcional) Mudar nome de host do raspberry
    * Modificar arquivo hosts no Pi - http://www.howtogeek.com/167195/how-to-change-your-raspberry-pi-or-other-linux-devices-hostname/
  * Instalar e Configurar NGINX
    * sudo apt-get install nginx
    * update-rc.d nginx defaults
    * sudo service nginx start
    * Modificar Arquivo /etc/nginx/nginx.conf - https://github.com/marcosbenaion/housekeeping/blob/master/arquivosConfiguracao/nginx.conf
    * Reiniciar NGINX - sudo service nginx restart
    * (créditos: http://alexba.in/blog/2013/11/02/lirc-web-nginx-and-upstart/)
  * Instalar SQlite3
    * sudo apt-get install sqlite3 libsqlite3-dev
  * Instalar PHP
    * sudo apt-get install php5-fpm
    * (créditos: https://www.raspberrypi.org/documentation/remote-access/web-server/nginx.md)
  * Criar pasta 'housekeeping' em /var/www/html
  * Copiar pasta website (https://github.com/marcosbenaion/housekeeping/tree/master/website) para pasta housekeeping
  * Criar banco de dados sqlite em /home/pi/.housekeeping
    * (no local citado) sqlite3> .open hk.db
  * Executar script populate_db.py (https://github.com/marcosbenaion/housekeeping/blob/master/src/populate_db.py)
  * Abrir no navegador: http://housekeeping.local ou inserir o ip do raspberry

# Pagina Web (imagens):
  * Página Aparelhos Conectados: https://github.com/marcosbenaion/housekeeping/blob/master/imagens/aparelhos.png
  * Página Cadastrar Aparelho: https://github.com/marcosbenaion/housekeeping/blob/master/imagens/cadastro.png
  * Página Atualizar Cadastro: https://github.com/marcosbenaion/housekeeping/blob/master/imagens/atualizar.png
  * Página Histórico de Consumo: https://github.com/marcosbenaion/housekeeping/blob/master/imagens/historico.png
  * Página Ranking de Consumo: https://github.com/marcosbenaion/housekeeping/blob/master/imagens/ranking.png
  * (Website utiliza o estilo de interface METRO UI - https://metroui.org.ua/)
