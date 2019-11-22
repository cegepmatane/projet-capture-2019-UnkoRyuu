

var TemperartureDAO = function () {

    var initialiser = function(){
        console.log("TemperartureDAO initialisé");
    };

    this.recupereTemperatureAnnee = function () {
        const options = net.request({
            method: 'GET',
            protocol: 'http:',
            hostname: '51.91.96.142',
            port: 80,
            path: "/"+new Date().getFullYear()
        })

      const requette = new ClientRequest(options);
      requette.on('response', data => {
        console.log(data);
      });
      request.end();
    };

    initialiser();
};
