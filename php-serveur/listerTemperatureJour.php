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

$reponse = "<?xml version=\"1.0\" encoding=\"utf-8\"?>";

echo   $_GET['jour']."/". $_GET['mois'] ."/". $_GET['annee'];


if (isset($_GET['annee'],$_GET['mois'],$_GET['jour']))
{


  $reponse .= "<ListeTemperature date= '" . $_GET['jour']."/". $_GET['mois'] ."/". $_GET['annee']  ."'>";

  //foreach ($variable as $key => $value) {
    // <Temperature heure=”01”>
      // <Min> -3 </Min>
      // <Max>13</Max>
      // <Moyenne>2</Moyenne>
    // </Temperature>
  //}

  // if (condition) {  //not null
  //   <MinTotal>-12</MinTotal>
  //   <MaxTotal>20</MaxTotal>
  //   <MoyenneTotal>6</MoyenneTotal>
  // }


  $reponse .="</ListeTemperature>";

}
echo $reponse;
?>
