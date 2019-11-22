<?php
require "./connexion_bdd.php";

function ListeTemperatureParAnnee($annee){
  $bdd = connexion_bdd();
  $req = $bdd->prepare( 'SELECT AVG(temperature) AS "temperatureMoy",
                        MIN(temperature) AS "temperatureMin",
                        MAX(temperature) AS "temperatureMax",
                        extract(month from "dateReleve") AS "mois"
                        FROM "ReleveEnvironnement"
                        WHERE extract(year from "dateReleve") = ?
                        GROUP BY extract(month from "dateReleve")
                        ORDER BY extract(month from "dateReleve");');

  $req->execute(array($annee));
  return $req->fetch(PDO::FETCH_BOTH);
}

function MoyMinMaxParAnnee($annee){
  $bdd = connexion_bdd();
  $req = $bdd->prepare( 'SELECT AVG(temperature) AS "temperatureMoy",
                        MIN(temperature) AS "temperatureMin",
                        MAX(temperature) AS "temperatureMax"
                        FROM "ReleveEnvironnement"
                        WHERE extract(year from "dateReleve") = ?;');

  $req->execute(array($annee));
  return $req->fetch(PDO::FETCH_BOTH);
}

$reponse = "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

if (isset($_GET['annee']))
{
  $reponse .= "<ListeTemperature date= '". $_GET['annee'] ."'>\n";

  $listeTemperature = ListeTemperatureParAnnee($_GET['annee']);

  if (sizeof($listeTemperature) !=  0  ) {
    $reponse .= "<Temperature mois='" . $listeTemperature['mois'] . "'>\n";
      $reponse .= "<Min>".$listeTemperature['temperatureMin']."</Min>\n";
      $reponse .= "<Max>".$listeTemperature['temperatureMax']."</Max>\n";
      $reponse .= "<Moyenne>".$listeTemperature['temperatureMoy']."</Moyenne>\n";
    $reponse .= "</Temperature>\n";
    $resultat = MoyMinMaxParAnnee($_GET['annee']);
    if ($resultat != null) {
      var_dump($resultat);
      $reponse .= "<MinTotal>".$resultat['temperatureMin']."</MinTotal>\n";
      $reponse .= "<MaxTotal>".$resultat['temperatureMax']."</MaxTotal>\n";
      $reponse .= "<MoyenneTotal>".$resultat['temperatureMoy']."</MoyenneTotal>\n";
    }
  }


  $reponse .="</ListeTemperature>\n";

}
echo $reponse;
?>
