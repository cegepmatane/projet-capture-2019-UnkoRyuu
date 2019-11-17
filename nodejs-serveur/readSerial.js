const https = require('http');
const SerialPort = require('serialport');
const Readline = require('@serialport/parser-readline');
const port = new SerialPort('COM3', { baudRate: 9600 });
const parser = port.pipe(new Readline({ delimiter: '\n' }));
// Read the port data
port.on("open", () => {
	console.log('Arduino connecté!');
});

function creerJson(temperature, date){
	var jsonData = '{"releve":{"temperature":'+temperature+',"date":"'+date+'"}}';
	var jsonObj = JSON.parse(jsonData);
	console.log(jsonObj);

}

let i = 0;
parser.on('data', data =>{
	if(i!=0){
		console.log('Temperature: '+ data);
		let date_ob = new Date();
		let date = ("0" + date_ob.getDate()).slice(-2);
		let month = ("0" + (date_ob.getMonth() + 1)).slice(-2);
		let year = date_ob.getFullYear();
		let hours = date_ob.getHours();
		let minutes = date_ob.getMinutes();
		let seconds = date_ob.getSeconds();
		let dateActuel = year + "-" + month + "-" + date + " " + hours + ":" + minutes + ":" + seconds;
		console.log('Date: '+ dateActuel);
		let json = creerJson(data,dateActuel);
	}else {
		console.log("ETAT:"+data);
		i=1;
	}
});

