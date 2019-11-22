var TemperaturesAnneeVue = (function(){

  pageTemperatureAnneeVue = document.getElementById("page-temperature-annee").innerHTML;

  return function(releveTemperature)
  {
    this.afficher = function(){
      elementBody = document.getElementsByTagName("body")[0];
      elementBody.innerHTML = pageTemperatureAnneeVue;

      var listeTemperatureAnneePage = document.getElementById("liste-temperature-annee");

      var textLi= "";
      for(var temperatureAnnee in listeTemperatureAnnee){
        textLi +="<tr><td> Temperature : "+ listeTemperatureAnnee[temperatureAnnee]+"</td></tr>";
      }
      listeTemperatureAnneePage.innerHTML = textLi;
    }
  }

})();
