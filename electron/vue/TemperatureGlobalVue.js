var TemperatureGlobalVue = (function(){

  pageTemperatureVue = document.getElementById("page-temperature-globale").innerHTML;

  return function(releveTemperature)
  {
    this.afficher = function(){
      elementBody = document.getElementsByTagName("body")[0];
      elementBody.innerHTML = pageTemperatureVue;
      var tableMoyenne = document.getElementById("table-moyenne");
      console.log(releveTemperature);

      var table = "<tr>";
      table += "<td>"+releveTemperature.minAnnee+"</td>";

      table += "<td>"+releveTemperature.maxAnnee+"</td>";

      table += "<td>"+releveTemperature.moyenneAnnee+"</td>";

      table += "<td>"+releveTemperature.moyenneMois+"</td>";

      table += "<td>"+releveTemperature.moyenneJour+"</td>";

      table += "<td>"+releveTemperature.temperatureActuel+"</td>";

      table += "</tr>";
      tableMoyenne.innerHTML = table;
    }
  }

})();
