var TemperaturesJourVue = (function(){

  pageTemperatureJourVue = document.getElementById("page-temperature-jour").innerHTML;

  return function(releveTemperature)
  {
    this.afficher = function(){
      elementBody = document.getElementsByTagName("body")[0];
      elementBody.innerHTML = pageTemperatureJourVue;
      var tableJour = document.getElementById("table-jour");

      console.log(releveTemperature);

      var table = "<tr>";

      table += "<td>"+releveTemperature.momentTemps+"</td>";
      table += "<td>"+releveTemperature.temperatureMin+"</td>";
      table += "<td>"+releveTemperature.temperatureMax+"</td>";
      table += "<td>"+releveTemperature.temperatureMoy+"</td>";
      table += "</tr>";
      tableJour.innerHTML = table;

      var tableHeure = document.getElementById("table-heure");
      var table = "";
      console.log(releveTemperature.sousMoments);

      releveTemperature.sousMoments.forEach(function(heure){
        console.log(heure);
        table += "<tr>";
        table += "<td>"+heure.momentTemps+"</td>";
        table += "<td>"+heure.temperatureMin+"</td>";
        table += "<td>"+heure.temperatureMax+"</td>";
        table += "<td>"+heure.temperatureMoy+"</td>";
        table += "</tr>";
      });
      tableHeure.innerHTML = table;
    }
  }

})();
