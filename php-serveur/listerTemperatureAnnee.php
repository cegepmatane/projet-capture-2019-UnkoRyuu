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
  return $req->fetchAll();
}

function MoyMinMaxParAnnee($annee){
  $bdd = connexion_bdd();
  $req = $bdd->prepare( 'SELECT AVG(temperature) AS "temperatureMoy",
                        MIN(temperature) AS "temperatureMin",
                        MAX(temperature) AS "temperatureMax"
                        FROM "ReleveEnvironnement"
                        WHERE extract(year from "dateReleve") = ?;');

  $req->execute(array($annee));
  return $req->fetch(PDO::FETCH_ASSOC);
}

$reponse = "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

if (isset($_GET['annee']))
{
  $reponse .= "<ListeTemperature date= '". $_GET['annee'] ."'>\n";

  $listeTemperature = ListeTemperatureParAnnee($_GET['annee']);


  if (sizeof($listeTemperature) !=  0  ) {
    foreach ($listeTemperature as $key ) {
      $reponse .= "<Temperature mois='" . $key['mois'] . "'>\n";
        $reponse .= "<Min>".$key['temperatureMin']."</Min>\n";
        $reponse .= "<Max>".$key['temperatureMax']."</Max>\n";
        $reponse .= "<Moyenne>".$key['temperatureMoy']."</Moyenne>\n";
      $reponse .= "</Temperature>\n";
    }

    $resultat = MoyMinMaxParAnnee($_GET['annee']);
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
