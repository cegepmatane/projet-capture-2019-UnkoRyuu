<?php
require "./connexion_bdd.php";

function temperatureMoyParAnnee($annee){
  $bdd = connexion_bdd();
  $req = $bdd->prepare( 'SELECT AVG(temperature) AS "temperatureMoy",
                        MIN(temperature) AS "temperatureMin",
                        MAX(temperature) AS "temperatureMax"
                        FROM "ReleveEnvironnement"
                        WHERE extract(year from "dateReleve") = ?;' );

  $req->execute(array($annee));
  return $req->fetch(PDO::FETCH_BOTH);
}

function temperatureMoyParAnneeMois($annee,$mois){
  $bdd = connexion_bdd();
  $req = $bdd->prepare( 'SELECT AVG(temperature) AS "temperatureMoy"
                        FROM "ReleveEnvironnement"
                        WHERE extract(year from "dateReleve") = ?
                        AND extract(month from "dateReleve") = ?;' );

  $req->execute(array($annee,$mois));
  return $req->fetch(PDO::FETCH_BOTH);
}

function temperatureMoyParAnneeMoisJour($annee,$mois,$jour){
  $bdd = connexion_bdd();
  $req = $bdd->prepare( 'SELECT AVG(temperature) AS "temperatureMoy"
                        FROM "ReleveEnvironnement"
                        WHERE extract(year from "dateReleve") = ?
                        AND extract(month from "dateReleve") = ?
                        AND extract(day from "dateReleve") = ?;' );

  $req->execute(array($annee,$mois,$jour));
  return $req->fetch(PDO::FETCH_BOTH);
}

function temperatureActuel(){
  $bdd = connexion_bdd();
  $req = $bdd->prepare( 'SELECT temperature
                        FROM "ReleveEnvironnement"
                        ORDER BY id DESC LIMIT 1;' );

  $req->execute();
  return $req->fetch(PDO::FETCH_BOTH);
}


$annee = date("Y");
$mois = date("m");
$jour = date("d");



$reponse = "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

$reponse .= "<Temperature>\n";

$reponse .= "<Moyenne>\n";
$tempAnnee = temperatureMoyParAnnee($annee);
if ($tempAnnee != null) {
  $reponse .= "<Annee>".$tempAnnee['temperatureMoy']."</Annee>\n";
}
$tempAnneeMois = temperatureMoyParAnneeMois($annee,$mois);
if ($tempAnneeMois != null) {
  $reponse .= "<Mois>".$tempAnneeMois['temperatureMoy']."</Mois>\n";
}

$tempAnneeMoisJour = temperatureMoyParAnneeMoisJour($annee,$mois,$jour);
if ($tempAnneeMoisJour != null) {

  $reponse .= "<Jour>".$tempAnneeMoisJour['temperatureMoy']."</Jour>\n";
}

$reponse .=   "</Moyenne>\n";
if ($tempAnnee != null) {
  $reponse .=   "<MinAnnee>".$tempAnnee['temperatureMin']."</MinAnnee>\n";
  $reponse .=   "<MaxAnnee>".$tempAnnee['temperatureMax']."</MaxAnnee>\n";
}
$temperatureActuel = temperatureActuel();
if ($temperatureActuel != null) {
  $reponse .=   "<TemperatureActuel>".$temperatureActuel['temperature']."</TemperatureActuel>\n";
}
$reponse .= "</Temperature>\n";

echo $reponse;
?>
