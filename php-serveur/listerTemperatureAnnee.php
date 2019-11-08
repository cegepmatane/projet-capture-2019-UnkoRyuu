<?php


$reponse = "<?xml version=\"1.0\" encoding=\"utf-8\"?><resultat>";

if (isset($_GET['annee'])){


  $reponse .= "<ListeTemperature date= '". $_GET['annee'] ."'>";

  //foreach ($variable as $key => $value) {
    // <Temperature annee=”2019”>
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


  $reponse .="</ListeTemperature>"

}
echo $reponse;
?>
