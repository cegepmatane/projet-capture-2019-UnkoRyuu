<?php
require "./connexion_bdd.php";

function ListeTemperatureParAnneeMois($annee, $mois){
  $bdd = connexion_bdd();
  $req = $bdd->prepare( 'SELECT AVG(temperature) AS "temperatureMoy",
                        MIN(temperature) AS "temperatureMin",
                        MAX(temperature) AS "temperatureMax",
                        extract(day from "dateReleve") AS jour
                        FROM "ReleveEnvironnement"
                        WHERE extract(year from "dateReleve") = ?
                        AND extract(month from "dateReleve") = ?
                        GROUP BY extracT(day from "dateReleve")
                        ORDER BY extract(day from "dateReleve");' );

  $req->execute(array($annee, $mois));
  return $req->fetchAll();
}

function MoyMinMaxParAnneeMois($annee, $mois){
  $bdd = connexion_bdd();
  $req = $bdd->prepare( 'SELECT AVG(temperature) AS "temperatureMoy",
                        MIN(temperature) AS "temperatureMin",
                        MAX(temperature) AS "temperatureMax"
                        FROM "ReleveEnvironnement"
                        WHERE extract(year from "dateReleve") = ?
                        AND extract(month from "dateReleve") = ?;');

  $req->execute(array($annee, $mois));
  return $req->fetch(PDO::FETCH_BOTH);
}



$reponse = "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";



if (isset($_GET['annee'],$_GET['mois']))
{


  $reponse .= "<ListeTemperature date= '". $_GET['mois'] ."/". $_GET['annee'] ."'>\n";

  $listeTemperature = ListeTemperatureParAnneeMois($_GET['annee'],$_GET['mois']);
  if (sizeof($listeTemperature) !=  0  ) {
    foreach ($listeTemperature as $key ) {
      $reponse .= "<Temperature jour='" . $key['jour'] . "'>\n";
        $reponse .= "<Min>".$key['temperatureMin']."</Min>\n";
        $reponse .= "<Max>".$key['temperatureMax']."</Max>\n";
        $reponse .= "<Moyenne>".$key['temperatureMoy']."</Moyenne>\n";
      $reponse .= "</Temperature>\n";
    }

    $resultat = MoyMinMaxParAnneeMois($_GET['annee'],$_GET['mois']);
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
