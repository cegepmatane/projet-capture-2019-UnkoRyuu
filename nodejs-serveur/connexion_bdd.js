/*const Client = require('pg')

const client = new Client ({
  user: 'php-ProjetCapture',
  host: '51.91.96.142',
  database: 'ProjetCapture',
  password: 'mdp-ProjetCapture',
  port: 5432
})
client.connect()

client.query('INSERT INTO ReleveEnvironnment (temperature) VALUES (1)'); (err, res) =­­> {
  console.log(err, res)
  client.end()
})*/


const {Pool, Client} = require('pg')

const pool = new Pool({
  user: 'php-ProjetCapture',
  host: '51.91.96.142',
  database: 'ProjetCapture',
  password: 'mdp-ProjetCapture',
  port: 5432
})

pool.query('SELECT NOW()', (err, res) => {
  console.log(err,res)
  pool.end()
})

const client = new Client({
  user: 'php-ProjetCapture',
  host: '51.91.96.142',
  database: 'ProjetCapture',
  password: 'mdp-ProjetCapture',
  port: 5432
})
client.connect()

client.query('SELECT NOW()', (err, res) => {
  console.log(err, res)
  client.end()
})