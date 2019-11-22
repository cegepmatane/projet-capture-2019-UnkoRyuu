(function () {

    var initialiser = function () {
        window.addEventListener("hashchange", naviguer);
        temperatureDAO = new TemperartureDAO();
        naviguer();
    }

    var naviguer = function () {
        var listeTemperatureHeure = ["26", "23", "12", "28"];
        var listeTemperatureMois = ["28", "20", "14", "30"];
        var listeTemperatureAnnee = ["30", "26", "24", "32"];
        var hash = window.location.hash;
        if (!hash || hash.match(/^#page-temperature-global/)) {
            releveTemperature = temperatureDAO.recupereTemperatureGlobal();
            var pageGlobale = new TemperaturesVue();
            pageGlobale.afficher();
        } else if (hash.match(/^#page-temperature-jour/)) {
            releveTemperature = temperatureDAO.recupereTemperatureAnneeMoisJour();
            var pageJour = new TemperaturesJourVue(listeTemperatureHeure);
            pageJour.afficher();
        } else if (hash.match(/^#page-temperature-mois/)) {
            releveTemperature = temperatureDAO.recupereTemperatureAnneeMois();
            var pageMois = new TemperaturesMoisVue(listeTemperatureMois);
            pageMois.afficher();
        } else if (hash.match(/^#page-temperature-annee/)) {
            releveTemperature = temperatureDAO.recupereTemperatureAnnee();
            var pageAnnee = new TemperaturesAnneeVue(listeTemperatureAnnee);
            pageAnnee.afficher();
        } else {
            console.log("rien");
        }
    }


    initialiser();
})();
