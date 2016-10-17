<?php
  session_start();

  // connect to database
  $host = 'localhost';
  $db_user = 'root';
  $db_password = 'simplonco';
  $db_name = 'EVAL-RNCP-B';


?>


<!DOCTYPE html>
<html>

  <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!--<link href="css/bootstrap.min.css" rel="stylesheet">-->
      <link href="css/custom.css" rel="stylesheet">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
      <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
      <title>Checking Mail in Secours Catholique</title>
  </head>
  <body>
      <div class="header">
        <h1>Page D'inscription</h1>
      </div>

      <form method="post" action="registration_page.php">
        <table>
          <tr>
            <td>Dom Asyl Number:</td>
            <td><input type="text" name="domasylnumber" class="textInput" /></td>
          </tr>
          <tr>
            <td>Nom:</td>
            <td><input type="text" name="surname" class="textInput" /></td>
          </tr>
          <tr>
            <td>Prenom:</td>
            <td><input type="text" name="firstname" class="textInput" /></td>
          </tr>
          <tr>
            <td></td>
            <td><input type="submit" name="register_btn" value="Register" /></td>
          </tr>
        </table>
      </form>
  </body>
</html>
