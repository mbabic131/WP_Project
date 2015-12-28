<?php session_start() ?>

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

    <title>Signin Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">

  </head>

  <body>

    <div class="container">

      <form class="form-signin" method="post" action="">
        <h2 class="form-signin-heading">Please sign in</h2>
        <label for="inputEmail" class="sr-only">Username</label>
        <input type="text" id="username" name="username" class="form-control" placeholder="Enter username" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Sign in</button> 
        <h3>OR</h3>
        <a href="registration.php"><button class="btn btn-lg btn-primary btn-block" type="button" name="login">Register</button></a>
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

  if(isset($_POST['submit'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $user = new \users\Users($db, $username, $password, null);

  } else if($_GET['action'] == 'logout') {

      session_destroy();
      echo "<h3 class='text-center'>You are loged out.</h3>";
  }

?>
