var TemperaturesVue = (function(){

  pageTemperatureVue = document.getElementById("page-temperature-globale").innerHTML;

  return function()
  {
    this.afficher = function(){
      elementBody = document.getElementsByTagName("body")[0];
      elementBody.innerHTML = pageTemperatureVue;
    }
  }

})();
