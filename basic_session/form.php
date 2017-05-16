<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
  <title>PHP Practice</title>
</head>

<body>

<?php
// Pulls the form from an html file
require("form.html");

// When the submit button is pressed
if(isset($_POST["submit"])) {
  // If both fields are filled
  if ($_POST["username"] != "" && $_POST["password"] != "") {
    // Set the variables
    $username = $_POST["username"];
    $password = $_POST["password"];
    $_SESSION["username"] = $username;
    ?> <b>You are logged in as <?php echo $_SESSION["username"];?></b><?php
  } else {
    ?><b>Invalid Input</b><?php
   }
}
if(isset($_POST["logout"])){
  session_unset();
  session_destroy();
  ?><b>You are not logged in</b><?php
}
  ?>

</body>
</html>
