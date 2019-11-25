var TemperaturesAnneeVue = (function(){

  pageTemperatureAnneeVue = document.getElementById("page-temperature-annee").innerHTML;

  return function(releveTemperature)
  {
    this.afficher = function(){
      elementBody = document.getElementsByTagName("body")[0];
      elementBody.innerHTML = pageTemperatureAnneeVue;
      var tableAnnee = document.getElementById("table-annee");

      console.log(releveTemperature);


      var table = "<tr>";

      table += "<td>"+releveTemperature.momentTemps+"</td>";
      table += "<td>"+releveTemperature.temperatureMin+"</td>";
      table += "<td>"+releveTemperature.temperatureMax+"</td>";
      table += "<td>"+releveTemperature.temperatureMoy+"</td>";
      table += "</tr>";
      tableAnnee.innerHTML = table;

      var tableMois = document.getElementById("table-mois");
      var table = "";
      console.log(releveTemperature.sousMoments);

      releveTemperature.sousMoments.forEach(function(mois){
        console.log(mois);
        table += "<tr>";
        table += "<td>"+mois.momentTemps+"</td>";
        table += "<td>"+mois.temperatureMin+"</td>";
        table += "<td>"+mois.temperatureMax+"</td>";
        table += "<td>"+mois.temperatureMoy+"</td>";
        table += "</tr>";
      });
      tableMois.innerHTML = table;
    }
  }

})();
