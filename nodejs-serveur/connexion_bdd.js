


const {Client} = require('pg');

exports.insertBDD = async function(temperatureJSON) {
  var bdd = new Client({
    user: 'php-ProjetCapture',
    host: 'localhost',
    database: 'ProjetCapture',
    password: 'mdp-ProjetCapture',
    port: 5432
  });
  await bdd.connect();

  await bdd.query("INSERT INTO \"ReleveEnvironnement\"(temperature) VALUES (1)",(err, res)=>{
    console.log(err,res);
    bdd.end();
  });
};

