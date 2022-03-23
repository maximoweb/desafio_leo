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


? Arquivo de Configuração do Banco de Dados
\App\Config\Conexao.php (Conexao_modelo.php - Alterar e Renomear)