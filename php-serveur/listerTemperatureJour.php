<?php
require "./connexion_bdd.php";

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
