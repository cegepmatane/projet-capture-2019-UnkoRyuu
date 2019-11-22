(function () {

    var initialiser = function () {
        window.addEventListener("hashchange", naviguer);
        temperatureDAO = new TemperartureDAO();
        naviguer();
    }

    var naviguer = async function () {
        var hash = window.location.hash;
        if (!hash || hash.match(/^#page-temperature-global/)) {
            releveTemperature = await temperatureDAO.recupereTemperatureGlobal();
            var pageGlobale = new TemperatureGlobalVue(releveTemperature);
            pageGlobale.afficher();
        } else if (hash.match(/^#page-temperature-jour/)) {
            releveTemperature = await temperatureDAO.recupereTemperatureAnneeMoisJour();
            var pageJour = new TemperaturesJourVue(releveTemperature);
            pageJour.afficher();
        } else if (hash.match(/^#page-temperature-mois/)) {
            releveTemperature = await temperatureDAO.recupereTemperatureAnneeMois();
            var pageMois = new TemperaturesMoisVue(releveTemperature);
            pageMois.afficher();
        } else if (hash.match(/^#page-temperature-annee/)) {
            releveTemperature = await temperatureDAO.recupereTemperatureAnnee();
            var pageAnnee = new TemperaturesAnneeVue(releveTemperature);
            pageAnnee.afficher();
        } else {
            console.log("rien");
        }
    }


    initialiser();
})();
