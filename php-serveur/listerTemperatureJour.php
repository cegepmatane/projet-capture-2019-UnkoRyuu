<?php
require "./connexion_bdd.php";

function ListeTemperatureParAnneeMoisJour($annee, $mois, $jour){
  $bdd = connexion_bdd();
  $req = $bdd->prepare( 'SELECT AVG(temperature) AS "temperatureMoy",
                        MIN(temperature) AS "temperatureMin",
                        MAX(temperature) AS "temperatureMax",
                        extract(hour from "dateReleve") AS heure
                        FROM "ReleveEnvironnement"
                        WHERE extract(year from "dateReleve") = ?
                        AND extract(month from "dateReleve") = ?
                        AND extract(day from "dateReleve") = ?
                        GROUP BY extract(hour from "dateReleve")
                        ORDER BY extract(hour from "dateReleve"); ');

  $req->execute(array($annee, $mois, $jour));
  return $req->fetchAll();
}

function MoyMinMaxParAnneeMoisJour($annee, $mois, $jour){
  $bdd = connexion_bdd();
  $req = $bdd->prepare( 'SELECT AVG(temperature) AS "temperatureMoy",
                        MIN(temperature) AS "temperatureMin",
                        MAX(temperature) AS "temperatureMax"
                        FROM "ReleveEnvironnement"
                        WHERE extract(year from "dateReleve") = ?
                        AND extract(month from "dateReleve") = ?
                        AND extract(day from "dateReleve") = ?;');

  $req->execute(array($annee, $mois, $jour));
  return $req->fetch(PDO::FETCH_BOTH);
}

$reponse = "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n\n";


if (isset($_GET['annee'],$_GET['mois'],$_GET['jour']))
{


  $reponse .= "<ListeTemperature date= '" . $_GET['jour']."/". $_GET['mois'] ."/". $_GET['annee']  ."'>\n";

  $listeTemperature = ListeTemperatureParAnneeMoisJour($_GET['annee'],$_GET['mois'],$_GET['jour']);

  if (sizeof($listeTemperature) !=  0  ) {
    foreach ($listeTemperature as $key ) {
      $reponse .= "<Temperature heure='" . $key['heure'] . "'>\n";
        $reponse .= "<Min>".$key['temperatureMin']."</Min>\n";
        $reponse .= "<Max>".$key['temperatureMax']."</Max>\n";
        $reponse .= "<Moyenne>".$key['temperatureMoy']."</Moyenne>\n";
      $reponse .= "</Temperature>\n";
    }

    $resultat = MoyMinMaxParAnneeMoisJour($_GET['annee'],$_GET['mois'],$_GET['jour']);
    if ($resultat != null) {
      $reponse .= "<MinTotal>".$resultat['temperatureMin']."</MinTotal>\n";
      $reponse .= "<MaxTotal>".$resultat['temperatureMax']."</MaxTotal>\n";
      $reponse .= "<MoyenneTotal>".$resultat['temperatureMoy']."</MoyenneTotal>\n";
    }
  }


  $reponse .="</ListeTemperature>\n";

}
echo $reponse;
?>
