(function(){


  var initialiser = function(){
    window.addEventListener("hashchange", naviguer);
    naviguer();
  }

  var naviguer = function(){
    var hash = window.location.hash;
    if(!hash){
      var pageGlobale = new TemperaturesVue();
      pageGlobale.afficher();
    }else if(hash.match(/^#page-temperature-jour/)) {
      var pageJour = new TemperaturesJourVue();
      pageJour.afficher();
    }else if(hash.match(/^#page-temperature-mois/)) {
      var pageMois = new TemperaturesMoisVue();
      pageMois.afficher();
    }else if(hash.match(/^#page-temperature-annee/)) {
    var pageAnnee = new TemperaturesAnneeVue();
    pageAnnee.afficher();
    }else{
    "Erreur dans l'application";
    }
  }



  initialiser();
})();
