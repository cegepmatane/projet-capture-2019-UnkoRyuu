var TemperaturesJourVue = (function(){

  pageTemperatureJourVue = document.getElementById("page-temperature-jour").innerHTML;

  return function(listeTemperatureHeure)
  {
    this.afficher = function(){
      elementBody = document.getElementsByTagName("body")[0];
      elementBody.innerHTML = pageTemperatureJourVue;

      var listeTemperatureHeurePage = document.getElementById("liste-temperature-jour");

      var textLi= "";
      for(var temperatureHeure in listeTemperatureHeure){
        textLi +="<tr><td> Temperature : "+ listeTemperatureHeure[temperatureHeure]+"</td></tr>";
      }
      listeTemperatureHeurePage.innerHTML = textLi;
    }
  }

})();
