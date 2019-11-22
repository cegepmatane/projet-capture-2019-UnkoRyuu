var connexion = require('./connexion_bdd.js');

var http = require('http');
var json = "";

var reponseRequete = async function(requete, reponse){
    console.log("\n\n\n");
    console.log('url: '+requete.url);
    console.log('method: '+requete.method);
    console.log('headers: '+requete.headers);
    console.log('body: '+requete.body);
    console.log("\n");

    requete.on('data', async function (data) {
      var jsonObj = JSON.parse(data);
    	console.log(jsonObj);
      console.log("\n");
      connexion.insertBDD(jsonObj.releve);
    });




    reponse.stastusCode = 200;
    reponse.setHeader('Content-Type','text/plain');
    reponse.end(json);


};


var serveur = http.createServer(reponseRequete);
serveur.listen(8080, '51.91.96.142', () => {
    console.log(`Serveur a l'écoute`);
});
