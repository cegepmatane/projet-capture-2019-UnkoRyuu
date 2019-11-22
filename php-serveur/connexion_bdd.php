<?php



function connexion_bdd(){
  $usager = 'php-ProjetCapture';
  $motdepasse = 'mdp-ProjetCapture';
  $hote = 'localhost';
  $base = 'ProjetCapture';
  $dsn = 'pgsql:dbname='.$base.';host=' . $hote;


  try{
    $conn = new PDO($dsn, $usager, $motdepasse);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if($conn){
      return	$conn ;
    }
  }catch (PDOException $e){
    echo $e->getMessage();
    echo "\n";
    return Null;
  }

}


?>
