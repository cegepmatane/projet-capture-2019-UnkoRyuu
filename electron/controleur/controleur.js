(function(){

  var initialiser = function(){
    window.addEventListener("hashchange", naviguer);
    naviguer();
  }

  var naviguer = function(){
    var listeTemperatureHeure = ["42", "23", "13", "17"];
    var listeTemperatureMois = ["20", "10", "12", "14"];
    var listeTemperatureAnnee = ["20", "9", "15", "16"];
    var hash = window.location.hash;
    if(!hash){
      var pageGlobale = new TemperaturesVue();
      pageGlobale.afficher();
    }else if(hash.match(/^#page-temperature-jour/)) {
      var pageJour = new TemperaturesJourVue(listeTemperatureHeure);
      pageJour.afficher();
    }else if(hash.match(/^#page-temperature-mois/)) {
      var pageMois = new TemperaturesMoisVue(listeTemperatureMois);
      pageMois.afficher();
    }else if(hash.match(/^#page-temperature-annee/)) {
    var pageAnnee = new TemperaturesAnneeVue(listeTemperatureAnnee);
    pageAnnee.afficher();
    }else{
    "Erreur dans l'application";
    }
  }



  initialiser();
})();
