<?php
require "./connexion_bdd.php";

$reponse = "<?xml version=\"1.0\" encoding=\"utf-8\"?>";


if ($resultat != null){  
  $reponse .= "<Temperature>";
  $reponse .= 	"<Moyenne>";
  $reponse .=     "<Annee>".$resultat->moyAnnee."</Annee>";
  $reponse .=     "<Mois>".$resultat->moyMois."</Mois>";
  $reponse .=     "<Jour>".$resultat->moyJour."</Jour>";
  $reponse .=   "</Moyenne>";
  $reponse .=   "<MinAnnee>".$resultat->temperatureMinAnnee."</MinAnnee>";
  $reponse .=   "<MaxAnnee>".$resultat->temperatureMaxAnnee."</MaxAnnee>";
  $reponse .=   "<TemperatureActuel>".$resultat->temperatureActuel."</TemperatureActuel>";
  $reponse .= "</Temperature>";
}



echo $reponse;
?>
