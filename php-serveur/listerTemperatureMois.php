<?php
require "./connexion_bdd.php";

function ListeTemperatureParAnneeMois($annee, $mois){
  $req = $bdd->prepare( "SELECT AVG(temperature) AS temperatureMoy,
                        MIN(column_name) AS temperatureMin,
                        MAX(column_name) AS temperatureMax,
                        day(date) AS jour,
                        FROM ReleveEnvironnement
                        WHERE year(date) = ?, month(date) = ?
                        GROUP BY day(date)
                        ORDER BY day(date);" );

  $req->execute(array($annee, $mois));
  return $req->fetch(PDO::FETCH_BOTH);
}

function MoyMinMaxParAnneeMois($annee, $mois){
  $req = $bdd->prepare( "SELECT AVG(temperature) AS temperatureMoy,
                        MIN(column_name) AS temperatureMin,
                        MAX(column_name) AS temperatureMax,
                        FROM ReleveEnvironnement
                        WHERE year(date) = ?, month(date) = ?;");

  $req->execute(array($annee, $mois));
  return $req->fetch(PDO::FETCH_BOTH);
}

$db = connexion_bdd();

$reponse = "<?xml version=\"1.0\" encoding=\"utf-8\"?>";

echo   $_GET['mois'] ."/". $_GET['annee'];

if (isset($_GET['annee'],$_GET['mois']))
{


  $reponse .= "<ListeTemperature date= '". $_GET['mois'] ."/". $_GET['annee'] ."'>";

  $listeTemperature = ListeTemperatureParAnneeMois($_GET['annee'],$_GET['mois']);
  foreach ($listeTemperature as $key => $value) {
    $reponse .= "<Temperature jour='".$jour."'>";
      $reponse .= "<Min>".$temperatureMin."</Min>";
      $reponse .= "<Max>".$temperatureMax."</Max>";
      $reponse .= "<Moyenne>".$temperatureMoy."</Moyenne>";
    $reponse .= "</Temperature>";
  }

  // if (condition) {  //not null
  //   <MinTotal>-12</MinTotal>
  //   <MaxTotal>20</MaxTotal>
  //   <MoyenneTotal>6</MoyenneTotal>
  // }


  $reponse .="</ListeTemperature>";

}
echo $reponse;
?>
