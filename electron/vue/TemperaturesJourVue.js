var TemperaturesJourVue = (function(){

  pageTemperatureJourVue = document.getElementById("page-temperature-jour").innerHTML;


  return function()
  {
    this.afficher = function(){
      elementBody = document.getElementsByTagName("body")[0];
      elementBody.innerHTML = pageTemperatureJourVue;
    }
  }

})();
