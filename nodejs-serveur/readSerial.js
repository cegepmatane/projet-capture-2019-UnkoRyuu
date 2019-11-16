var SerialPort = require("serialport");
const Readline = require('@serialport/parser-readline');

const port = new SerialPort("COM4", { baudRate: 9600 });

let temperature = [];
temperature[0] = null;
temperature[1] = null;
temperature[2] = null;
temperature[3] = null;

port.on('readable', function () {
	let lecturePort = port.read();
  	console.log('Data:', lecturePort);
  	console.log('Data:', String.fromCharCode(lecturePort[0],lecturePort[1],lecturePort[2],lecturePort[3]));

	lecturePort.forEach(element =>{
		if (temperature[0] == null){
		temperature[0] = element;
		} else if (temperature[1] == null){
		temperature[1] = element;
		} else if (temperature[2] == null){
		temperature[2] = element;
		} else if (temperature[3] == null){
		temperature[3] = element;
		}
	});
  		
  	if (temperature[3] != null){
  		console.log('temperature:', String.fromCharCode(temperature[0],temperature[1],temperature[2],temperature[3]));
  		temperature[0] = null;
		temperature[1] = null;
		temperature[2] = null;
		temperature[3] = null;
  	}
});