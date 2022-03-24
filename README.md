<h1 align="center">Desenvolvedor: Julio César S Fernandes</h1>
<h3 align="center">Processo Seletivo Back End - Desafio LEO</h3>



<h3 align="left">Languages and Tools:</h3>
<p align="left"> <a href="https://www.w3.org/html/" target="_blank" rel="noreferrer"> <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/html5/html5-original-wordmark.svg" alt="html5" width="40" height="40"/> </a> <a href="https://developer.mozilla.org/en-US/docs/Web/JavaScript" target="_blank" rel="noreferrer"> <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/javascript/javascript-original.svg" alt="javascript" width="40" height="40"/> </a> <a href="https://www.mysql.com/" target="_blank" rel="noreferrer"> <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/mysql/mysql-original-wordmark.svg" alt="mysql" width="40" height="40"/> </a> <a href="https://www.php.net" target="_blank" rel="noreferrer"> <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/php/php-original.svg" alt="php" width="40" height="40"/> </a> <a href="https://sass-lang.com" target="_blank" rel="noreferrer"> <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/sass/sass-original.svg" alt="sass" width="40" height="40"/> </a> </p>


//BANCO DE DADOS
desafio_leo;

CREATE TABLE `desleo_cursos` (                              
                 `CURSO_ID` int(8) NOT NULL AUTO_INCREMENT,                
                 `CURSO_USU_ID` int(8) DEFAULT 0,                          
                 `CURSO_DATA_ADD` datetime DEFAULT current_timestamp(),    
                 `CURSO_IMAGEM` varchar(64) DEFAULT NULL,                  
                 `CURSO_TITULO` varchar(64) DEFAULT NULL,                  
                 `CURSO_URL_AMIGAVEL` varchar(120) DEFAULT NULL,           
                 `CURSO_DESCRICAO` text DEFAULT NULL,                      
                 `CURSO_SESSION_ID` varchar(32) DEFAULT NULL,              
                 `CURSO_SLIDE` char(1) DEFAULT 'N',                        
                 `CURSO_STATUS` char(1) DEFAULT 'A',                       
                 PRIMARY KEY (`CURSO_ID`),                                 
                 UNIQUE KEY `CURSO_URL_AMIGAVEL_2` (`CURSO_URL_AMIGAVEL`)  
               ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4   


<h3>Arquivo de Configuração para conexao com Banco de Dados</h3>
<p>\App\Config\Conexao.php (Conexao_modelo.php - Alterar e Renomear)</p>
<h3>Arquivo de Configuração URL Base</h3>
<p>App\Config\Cfg.php</p>
<h3>Requisitos</h3>
<p>PHP 7.0 + / mysql / apache</p>

<hr>


<h3>Desafio LEO Learning</h3>
<h4>Orientações</h4>

<p>OK - Para o desenvolvimento do projeto deverá ser criado um repositório na conta do bitbucket ou github do candidato com o seguinte nome "desafio_leo"(ex.: http://bitbucket.org/seu_nome/desafio_leo).</p>
<p>OK - O desafio deve ser armazenado em seu respectivo repositório.</p>
<p>OK - Deve ser evidenciado a evolução do código desenvolvido (commitar sempre).</p>
<p>OK - No README deverá ter as informações do desenvolvedor e do projeto.</p>
<p>OK - Dê mais atenção a sua melhor skill.</p>

<h4>Front-end</h4>

<p>OK - O layout deverá respeitar um determinado grid com base no layout e ser acessível em resoluções menores, ex.: notebooks, tablets e smartphones. </p>
<p>OK - O markup deve ser desenvolvido utilizando HTML5, CSS (sass/less), JS (livre para usar libs, mas seria interessante criar do zero)</p>
<p>NÃO EFETUADO- e automatizador de tarefas (gulp/grunt).</p>

<h4>Back-end</h4>
<p>OK - Deve ser realizado o CRUD para: * Cursos. * Imagens, título, descrição e link do botão do Slideshow.</p>


<h4>Modal</h4>
<p>OK - Modal deve aparecer somente no primeiro acesso do usuário</p>

