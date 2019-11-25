var TemperaturesMoisVue = (function(){

  pageTemperatureMoisVue = document.getElementById("page-temperature-mois").innerHTML;

  return function(releveTemperature)
  {
    this.afficher = function(){
      elementBody = document.getElementsByTagName("body")[0];
      elementBody.innerHTML = pageTemperatureMoisVue;
      var tableMois = document.getElementById("table-mois");

      console.log(releveTemperature);

      var table = "<tr>";

      table += "<td>"+releveTemperature.momentTemps+"</td>";
      table += "<td>"+releveTemperature.temperatureMin+"</td>";
      table += "<td>"+releveTemperature.temperatureMax+"</td>";
      table += "<td>"+releveTemperature.temperatureMoy+"</td>";
      table += "</tr>";
      tableMois.innerHTML = table;

      var tableJour= document.getElementById("table-jour");
      var table = "";
      console.log(releveTemperature.sousMoments);

      releveTemperature.sousMoments.forEach(function(jour){
        console.log(jour);
        table += "<tr>";
        table += "<td>"+jour.momentTemps+"</td>";
        table += "<td>"+jour.temperatureMin+"</td>";
        table += "<td>"+jour.temperatureMax+"</td>";
        table += "<td>"+jour.temperatureMoy+"</td>";
        table += "</tr>";
      });
      tableJour.innerHTML = table;
    }
  }
})();
