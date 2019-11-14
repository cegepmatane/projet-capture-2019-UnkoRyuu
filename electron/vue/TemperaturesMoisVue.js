var TemperaturesMoisVue = (function(){

  pageTemperatureMoisVue = document.getElementById("page-temperature-mois").innerHTML;


  return function()
  {
    this.afficher = function(){
      elementBody = document.getElementsByTagName("body")[0];
      elementBody.innerHTML = pageTemperatureMoisVue;
    }
  }

})();





/*

*/
