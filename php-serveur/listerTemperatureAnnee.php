<?php
require "./connexion_bdd.php";

function ListeTemperatureParAnnee($annee){
  $req = $bdd->prepare( "SELECT AVG(temperature) AS temperatureMoy,
                        MIN(column_name) AS temperatureMin,
                        MAX(column_name) AS temperatureMax,
                        month(date) AS mois,
                        FROM ReleveEnvironnement
                        WHERE year(date) = ?
                        GROUP BY month(date)
                        ORDER BY month(date);" );

  $req->execute(array($annee));
  return $req->fetch(PDO::FETCH_BOTH);
}

function MoyMinMaxParAnnee($annee){
  $req = $bdd->prepare( "SELECT AVG(temperature) AS temperatureMoy,
                        MIN(column_name) AS temperatureMin,
                        MAX(column_name) AS temperatureMax,
                        FROM ReleveEnvironnement
                        WHERE year(date) = ?;");

  $req->execute(array($annee));
  return $req->fetch(PDO::FETCH_BOTH);
}


$reponse = "<?xml version=\"1.0\" encoding=\"utf-8\"?>";




if (isset($_GET['annee']))
{



  $reponse .= "<ListeTemperature date= '". $_GET['annee'] ."'>";

  $listeTemperature = ListeTemperatureParAnnee($_GET['annee']);

  foreach ($listeTemperature as $key => $value) {
    $reponse .= "<Temperature mois='".$mois."'>";
      $reponse .= "<Min>".$temperatureMin."</Min>";
      $reponse .= "<Max>".$temperatureMax."</Max>";
      $reponse .= "<Moyenne>".$temperatureMoy."</Moyenne>";
    $reponse .= "</Temperature>";
  }

  if ($listeTemperature != null) {
    $resultat = MoyMinMaxParAnnee($_GET['annee']);
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
