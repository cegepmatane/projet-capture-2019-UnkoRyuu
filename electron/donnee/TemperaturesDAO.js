var TemperartureDAO = function () {

    var initialiser = function () {
        console.log("TemperartureDAO initialisé");
    };


    this.recupereTemperatureAnnee = async function () {
        let response = await fetch('http://51.91.96.142' +
            '/AnalyseEnvironnement/listerTemperature/2019')
            .then(function (response) {
                return response.text();
            }).then(function (xml) {

                parser = new DOMParser();
                var reponse = parser.parseFromString(xml, "text/xml");
                console.log(reponse);
                var listeTemperature = reponse.getElementsByTagName("ListeTemperature")[0];
                for (let i = 0; i < listeTemperature.length - 3; i++) {
                    var moisXML = listeTemperature[i];
                    var mois = new Moment(
                        heureXML.getElementsByTagName("heure")[0].innerHTML,
                        heureXML.getElementsByTagName("temperature-moyenne")[0].innerHTML,
                        heureXML.getElementsByTagName("temperature-min")[0].innerHTML,
                        heureXML.getElementsByTagName("temperature-max")[0].innerHTML
                    );
                    jour.ajouterHeure(heure);
                }
            });

    };

    initialiser();
};
