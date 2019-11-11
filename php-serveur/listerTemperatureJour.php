<?php
require "./connexion_bdd.php";

function ListeTemperatureParAnneeMoisJour($annee, $mois, $jour){
  $req = $bdd->prepare( "SELECT AVG(temperature) AS temperatureMoy,
                        MIN(column_name) AS temperatureMin,
                        MAX(column_name) AS temperatureMax,
                        hour(date) AS heure,
                        FROM ReleveEnvironnement
                        WHERE year(date) = ?, month(date) = ?, day(date) = ?
                        GROUP BY hour(date)
                        ORDER BY hour(date);" );

  $req->execute(array($annee, $mois, $jour));
  return $req->fetch(PDO::FETCH_BOTH);
}

function MoyMinMaxParAnneeMoisJour($annee, $mois, $jour){
  $req = $bdd->prepare( "SELECT AVG(temperature) AS temperatureMoy,
                        MIN(column_name) AS temperatureMin,
                        MAX(column_name) AS temperatureMax,
                        FROM ReleveEnvironnement
                        WHERE year(date) = ?, month(date) = ?, day(date) = ?;");

  $req->execute(array($annee, $mois, $jour));
  return $req->fetch(PDO::FETCH_BOTH);
}

$reponse = "<?xml version=\"1.0\" encoding=\"utf-8\"?>";

echo   $_GET['jour']."/". $_GET['mois'] ."/". $_GET['annee'];


if (isset($_GET['annee'],$_GET['mois'],$_GET['jour']))
{


  $reponse .= "<ListeTemperature date= '" . $_GET['jour']."/". $_GET['mois'] ."/". $_GET['annee']  ."'>";

  $listeTemperature = ListeTemperatureParAnneeMoisJour($_GET['annee'],$_GET['mois'],$_GET['jour']);

  foreach ($listeTemperature as $key => $value) {
    $reponse .= "<Temperature heure='".$heure."'>";
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
