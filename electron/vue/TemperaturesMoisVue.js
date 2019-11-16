var TemperaturesMoisVue = (function(){

  pageTemperatureMoisVue = document.getElementById("page-temperature-mois").innerHTML;

  return function(listeTemperatureMois)
  {
    this.afficher = function(){
      elementBody = document.getElementsByTagName("body")[0];
      elementBody.innerHTML = pageTemperatureMoisVue;

      var listeTemperatureMoisPage = document.getElementById("liste-temperature-mois");

      var textLi= "";
      for(var temperatureMois in listeTemperatureMois){
        textLi +="<tr><td> Temperature : "+ listeTemperatureMois[temperatureMois]+"</td></tr>";
      }
      listeTemperatureMoisPage.innerHTML = textLi;
    }
  }

})();
