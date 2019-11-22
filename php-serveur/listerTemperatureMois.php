<?php
require "./connexion_bdd.php";

function ListeTemperatureParAnneeMois($annee, $mois){
  $bdd = connexion_bdd();
  $req = $bdd->prepare( "SELECT AVG(temperature) AS temperatureMoy,
                        MIN(temperature) AS temperatureMin,
                        MAX(temperature) AS temperatureMax,
                        day(date) AS jour,
                        FROM ReleveEnvironnement
                        WHERE year(date) = ?, month(date) = ?
                        GROUP BY day(date)
                        ORDER BY day(date);" );

  $req->execute(array($annee, $mois));
  return $req->fetch(PDO::FETCH_BOTH);
}

function MoyMinMaxParAnneeMois($annee, $mois){
  $bdd = connexion_bdd();
  $req = $bdd->prepare( "SELECT AVG(temperature) AS temperatureMoy,
                        MIN(temperature) AS temperatureMin,
                        MAX(temperature) AS temperatureMax,
                        FROM ReleveEnvironnement
                        WHERE year(date) = ?, month(date) = ?;");

  $req->execute(array($annee, $mois));
  return $req->fetch(PDO::FETCH_BOTH);
}



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

  if ($listeTemperature != null) {
    $resultat = MoyMinMaxParAnneeMois($_GET['annee'],$_GET['mois']);
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
