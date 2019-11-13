var SerialPort = require("serialport");
const Readline = require('@serialport/parser-readline');

const port = new SerialPort("COM4", { baudRate: 9600 });


port.on('readable', function () {
  console.log('Data:', port.read())
})