<?php
require "./connexion_bdd.php";

function ListeTemperatureParAnneeMoisJour($annee, $mois, $jour){
  $bdd = connexion_bdd();
  $req = $bdd->prepare( 'SELECT AVG(temperature) AS "temperatureMoy",
                        MIN(temperature) AS "temperatureMin",
                        MAX(temperature) AS "temperatureMax",
                        extract(hour from "dateReleve") AS heure,
                        FROM "ReleveEnvironnement"
                        WHERE extract(year from "dateReleve") = ?,
                        extract(month from "dateReleve") = ?,
                        extract(day from "dateReleve") = ?
                        GROUP BY (hour from "dateReleve")
                        ORDER BY (hour from "dateReleve"); ');

  $req->execute(array($annee, $mois, $jour));
  return $req->fetch(PDO::FETCH_BOTH);
}

function MoyMinMaxParAnneeMoisJour($annee, $mois, $jour){
  $bdd = connexion_bdd();
  $req = $bdd->prepare( 'SELECT AVG(temperature) AS "temperatureMoy",
                        MIN(temperature) AS "temperatureMin",
                        MAX(temperature) AS "temperatureMax"
                        FROM "ReleveEnvironnement"
                        WHERE extract(year from "dateReleve") = ?,
                        extract(month from "dateReleve") = ?,
                        extract(day from "dateReleve") = ?;');

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

  if ($listeTemperature != null) {
    $resultat = MoyMinMaxParAnneeMoisJour($_GET['annee'],$_GET['mois'],$_GET['jour']);
    if ($resultat != null) {
      $reponse .= "<MinTotal>".$resultat->temperatureMin."</MinTotal>";
      $reponse .= "<MaxTotal>".$resultat->temperatureMax."</MaxTotal>";
      $reponse .= "<MoyenneTotal>".$resultat->temperatureMoy."</MoyenneTotal>";
    }
  }


  $reponse .="</ListeTemperature>";

}
echo $reponse;
?>
