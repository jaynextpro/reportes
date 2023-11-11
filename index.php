<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  </head>
  <body style="text-align: center;">
    <h1>Generacion de reporte</h1>
    <form action="generar_reporte.php" method="POST">
      <label for="palabra_clave">Palabra clave</label>
      <input type="text" name="palabra_clave" id="palabra_clave">
      
      <label for="existencias">Existencias</label>
      <input type="number" name="existencias" id="existencias">

      <label for="vencimiento">Vencimiento</label>
      <input type="date" name="vencimiento" id="vencimiento">

      <input type="submit" name="generar" value="Generar">
    </form>
  </body>
</html>
