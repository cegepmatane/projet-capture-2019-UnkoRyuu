var connexion = require('./connexion_bdd.js');

var http = require('http');
var json = "";

var reponseRequete = async function(requete, reponse){
    console.log('url: '+requete.url);
    console.log('method: '+requete.method);
    console.log('headers: '+requete.headers);
    console.log('body: '+requete.body);


    requete.on('data', async function (data) {
        console.log('data : '+ data);
    });




    reponse.stastusCode = 200;
    reponse.setHeader('Content-Type','text/plain');
    reponse.end(json);

};

connexion.insertBDD(1);
var serveur = http.createServer(reponseRequete);
serveur.listen(8080, 'localhost', () => {
    console.log(`Serveur a l'écoute`);
});