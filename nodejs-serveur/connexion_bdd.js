


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


  let temperature = temperatureJSON.temperature;
  console.log("temperature : "+ temperature);

  let date = new Date(temperatureJSON.date);
  console.log("date : "+date);
  console.log("\n");
  let valeur = [temperature,date];
  let req = "INSERT INTO \"ReleveEnvironnement\"(temperature, \"dateReleve\") VALUES ( $1, $2 )";
  await bdd.query(req , valeur ,(err, res)=>{
    if (err) {
      console.log(err);
    } else {
      console.log(res);
    }
    bdd.end();
  });
};
