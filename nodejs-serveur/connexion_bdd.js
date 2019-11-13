var http = require('http'); //connexion en http 

var reponseRequete = function(requete, reponse){
  console.log('url: '+requete.url);
  console.log('method: '+requete.method);
  console.log('headers: '+requete.headers);
  console.log('body: '+requete.body); //log de recuperation de données 

  var json  = ''; // creation du json 

  if(requete.method === 'GET'){
    if (requete.url === '/activites') {
      json  = JSON.stringify(activites);
    }
    if (regex = requete.url.match(/\/activite-([0-9]+)/i) ){
      var id = regex[1];
      json  = JSON.stringify(activites[id]);
    }
  } //inscription des données serialisé dans le json 


  reponse.stastusCode = 200;
  reponse.setHeader('Content-Type','text/plain');
  reponse.end(json); //fermeture du json 

}

var serveur = http.createServer(reponseRequete);
serveur.listen(8080, '127.0.0.1', () => {
  console.log(`Bienvenue sur Analyse Envrinonemment`);
}); //connexion au serveur en local 