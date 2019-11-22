var TemperartureDAO = function () {

    var initialiser = function () {
        console.log("TemperartureDAO initialisé");
    };


    this.recupereTemperatureAnnee = async function () {
        var annee;

        var year = new Date().getFullYear();
        let response = await fetch('http://51.91.96.142' +
            '/AnalyseEnvironnement/listerTemperature/' + year)
            .then(function (response) {
                return response.text();
            }).then(function (xml) {

                parser = new DOMParser();
                var reponse = parser.parseFromString(xml, "text/xml");


                var listeTemperature = reponse.getElementsByTagName("ListeTemperature")[0];

                annee = new Moment(
                    listeTemperature.getAttribute("date"),
                    listeTemperature.getElementsByTagName("MinTotal")[0].innerHTML,
                    listeTemperature.getElementsByTagName("MaxTotal")[0].innerHTML,
                    listeTemperature.getElementsByTagName("MoyenneTotal")[0].innerHTML
                );

                listeTemperatureMois = listeTemperature.getElementsByTagName("Temperature");
                for (let i = 0; i < listeTemperatureMois.length; i++) {
                    var jourXML = listeTemperatureMois[i];
                    var mois = new Moment(
                        jourXML.getAttribute("mois"),
                        jourXML.getElementsByTagName("Min")[0].innerHTML,
                        jourXML.getElementsByTagName("Max")[0].innerHTML,
                        jourXML.getElementsByTagName("Moyenne")[0].innerHTML
                    );
                    console.log(mois);
                    annee.sousMoments.push(mois);
                }
                console.log(annee);


            });
        return annee;
    };

    this.recupereTemperatureAnneeMois = async function () {
        var mois;
        var year = new Date().getFullYear();
        var month = parseInt(new Date().getMonth()) + 1;
        let response = await fetch('http://51.91.96.142' +
            '/AnalyseEnvironnement/listerTemperature/' + year + '/' + month)
            .then(function (response) {
                return response.text();
            }).then(function (xml) {

                parser = new DOMParser();
                var reponse = parser.parseFromString(xml, "text/xml");


                var listeTemperature = reponse.getElementsByTagName("ListeTemperature")[0];

                mois = new Moment(
                    listeTemperature.getAttribute("date"),
                    listeTemperature.getElementsByTagName("MinTotal")[0].innerHTML,
                    listeTemperature.getElementsByTagName("MaxTotal")[0].innerHTML,
                    listeTemperature.getElementsByTagName("MoyenneTotal")[0].innerHTML
                );

                listeTemperatureMois = listeTemperature.getElementsByTagName("Temperature");
                for (let i = 0; i < listeTemperatureMois.length; i++) {
                    var jourXML = listeTemperatureMois[i];
                    var jour = new Moment(
                        jourXML.getAttribute("jour"),
                        jourXML.getElementsByTagName("Min")[0].innerHTML,
                        jourXML.getElementsByTagName("Max")[0].innerHTML,
                        jourXML.getElementsByTagName("Moyenne")[0].innerHTML
                    );
                    console.log(jour);
                    mois.sousMoments.push(jour);
                }
                console.log(mois);


            });
        return mois;
    };

    this.recupereTemperatureAnneeMoisJour = async function () {
        var jour;
        var year = new Date().getFullYear();
        var month = parseInt(new Date().getMonth()) + 1;
        var day = new Date().getDate();
        let response = await fetch('http://51.91.96.142' +
            '/AnalyseEnvironnement/listerTemperature/' + year + '/' + month + '/' + day)
            .then(function (response) {
                return response.text();
            }).then(function (xml) {

                parser = new DOMParser();
                var reponse = parser.parseFromString(xml, "text/xml");


                var listeTemperature = reponse.getElementsByTagName("ListeTemperature")[0];

                jour = new Moment(
                    listeTemperature.getAttribute("date"),
                    listeTemperature.getElementsByTagName("MinTotal")[0].innerHTML,
                    listeTemperature.getElementsByTagName("MaxTotal")[0].innerHTML,
                    listeTemperature.getElementsByTagName("MoyenneTotal")[0].innerHTML
                );

                listeTemperatureMois = listeTemperature.getElementsByTagName("Temperature");
                for (let i = 0; i < listeTemperatureMois.length; i++) {
                    var heureXML = listeTemperatureMois[i];
                    var heure = new Moment(
                        heureXML.getAttribute("heure"),
                        heureXML.getElementsByTagName("Min")[0].innerHTML,
                        heureXML.getElementsByTagName("Max")[0].innerHTML,
                        heureXML.getElementsByTagName("Moyenne")[0].innerHTML
                    );
                    console.log(heure);
                    jour.sousMoments.push(heure);
                }
                console.log(jour);


            });
        return jour;
    };

    this.recupereTemperatureGlobal = async function () {
        var global;

        let response = await fetch('http://51.91.96.142' +
            '/AnalyseEnvironnement/listerTemperature/global')
            .then(function (response) {
                return response.text();
            }).then(function (xml) {

                parser = new DOMParser();
                var reponse = parser.parseFromString(xml, "text/xml");

                var temperature = reponse.getElementsByTagName("Temperature")[0];
                var moyenne = temperature.getElementsByTagName("Moyenne")[0];

                global = new Global(
                    moyenne.getElementsByTagName("Annee")[0].innerHTML,
                    moyenne.getElementsByTagName("Mois")[0].innerHTML,
                    moyenne.getElementsByTagName("Jour")[0].innerHTML,
                    temperature.getElementsByTagName("MinAnnee")[0].innerHTML,
                    temperature.getElementsByTagName("MaxAnnee")[0].innerHTML,
                    temperature.getElementsByTagName("TemperatureActuel")[0].innerHTML
                );

                console.log(global);


            });
        return global;
    };

    initialiser();
};
