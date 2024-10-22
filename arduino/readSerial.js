const http = require('http')
const SerialPort = require('serialport');
const Readline = require('@serialport/parser-readline');
const port = new SerialPort('COM3', { baudRate: 9600 });
const parser = port.pipe(new Readline({ delimiter: '\n' }));
// Read the port data
port.on("open", () => {
	console.log('Arduino connecté!');
});

function creerJson(temperatureDonnee, dateDonnee){
	var jsonData = JSON.stringify({
	  releve: {
			temperature: temperatureDonnee ,
			date: dateDonnee
		}
	});
	var jsonObj = JSON.parse(jsonData);
	console.log(jsonObj);
	return jsonData;
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
		var dateActuel = year + "-" + month + "-" + date + " " + hours + ":" + minutes + ":" + seconds;
		console.log('Date: '+ dateActuel);
		let json = creerJson(data,dateActuel);
		requetteHttp(json);
	}else {
		console.log("ETAT:"+data);
		i=1;
	}
});


var requetteHttp = async function (data) {
	const options = {
		hostname: '51.91.96.142',
		port: 8080,
		path: '/',
		headers: {
			'Content-Type': 'application/json',
			'Content-Length': data.length
		}
	};

	const req = http.request(options, (res) => {
		console.log(`statusCode: ${res.statusCode}`);

		res.on('data', (d) => {
			process.stdout.write(d)
		});
	});

	req.on('error', (error) => {
		console.error(error)
	});

	req.write(data);
	req.end();
};
