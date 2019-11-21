var TemperartureDAO = function(){
  connection.query('SELECT * FROM `temperature` WHERE 1', function(err, rows, fields) {
  if (err) throw err;
    for (var i = 0; i < rows.length; i++) {
      result = rows; //je stock le résultat dans une variable pour l'envoyer à la vue
    };
});
}
