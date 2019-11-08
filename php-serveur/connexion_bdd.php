<?php
define('DB_USER', "php-ProjetCapture"); // db user
define('DB_PASSWORD', "mdp-ProjetCapture"); // db password (mention your db password here)
define('DB_DATABASE', "ProjetCapture"); // database name
define('DB_SERVER', "localhost"); // db server



function connexion_bdd(){
  $postgreDB = new PDO();
	return	$postgreDB ;
}


?>
