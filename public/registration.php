<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Registracija</title>

    <!-- Bootstrap core CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">

  </head>

  <body>

    <div class="container">

<form class="form-horizontal" action='' method="POST">
  <fieldset>
    <div id="legend">
      <legend class="">Registriraj se</legend>
    </div>
    <div class="control-group">
      <!-- Username -->
      <label class="control-label"  for="username">Korisničko ime</label>
      <div class="controls">
        <input type="text" id="username" name="username" placeholder="" class="input-xlarge" maxlength="50" required>
        <p class="help-block">Korisničko ime može sadržavati bilo koje slovo ili broj, bez razmaka.</p>
      </div>
    </div>
 
    <div class="control-group">
      <!-- Password-->
      <label class="control-label" for="password">Lozinka</label>
      <div class="controls">
        <input type="password" id="password" name="password" placeholder="" class="input-xlarge" maxlength="50" required>
        <p class="help-block">Lozinka mora imati najmanje 4 znaka.</p>
      </div>
    </div>
 
    <div class="control-group">
      <!-- Password -->
      <label class="control-label"  for="password_confirm">Lozinka (Potvrda)</label>
      <div class="controls">
        <input type="password" id="password_confirm" name="password_confirm" placeholder="" class="input-xlarge" maxlength="50" required>
        <p class="help-block">Potvrdite Vašu lozinku.</p>
      </div>
    </div>
 
    <div class="control-group">
      <!-- Button -->
      <div class="controls">
        <button type="submit" class="btn btn-success" name="submit">Potvrdi</button>
      </div>
      <p>Ako ste već registrirani možete se prijaviti <a href="login.php?action=login">ovdje.</a></p>
    </div>
  </fieldset>
</form>

</div> <!-- /container -->

  </body>
</html>

<?php

// get database connection
  include_once '../config/databaseC.php';
  $database = new \config\databaseC();
  $db = $database->getConnection();

  include_once '../objects/users.php';
  include_once '../helpers/validation.php';

if(isset($_POST['submit'])) {

    if(!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['password_confirm'])) {

      $username = $_POST['username'];
      $password = $_POST['password'];
      $password_confirm = $_POST['password_confirm'];

      if(validate_user($username, gettype($username), 1) && validate_user($password, gettype($password), 4) && validate_user($password_confirm, gettype($password_confirm), 4)) {

        $user = new \users\Users($db, $username, $password, $password_confirm);
      } else {

        echo "<h4 class='text-center'>Niste ispravno popunili potrebna polja.</h4>";
      }


    } else {

      echo "<h3 class='text-center'>Morate ispuniti sva polja s ispravnim podacima.</h3>";
    }
}

?>