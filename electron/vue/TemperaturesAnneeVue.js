var TemperaturesAnneeVue = (function(){

  pageTemperatureAnneeVue = document.getElementById("page-temperature-annee").innerHTML;


  return function()
  {
    this.afficher = function(){
      elementBody = document.getElementsByTagName("body")[0];
      elementBody.innerHTML = pageTemperatureAnneeVue;
    }
  }

})();




/*

*/
