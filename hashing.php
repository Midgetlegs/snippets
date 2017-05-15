<!DOCTYPE html>
<html>
<head>
  <title>Password Hashing</title>
</head>

<body>

<form action="hashing.php" method="post">
  <input type="text" name="text" placeholder="Enter text" />
  <input type="submit" name="sub" value="Hash It!" />
</form>

<?php
echo "<h2>Current Hash Algorithms</h2>";


if(isset($_POST["sub"])) {
  $pass = $_POST["text"];

  if ($pass != "") {
    for ($i=0; $i < count(hash_algos()); $i++) {
      echo "<b>". (hash_algos()[$i]) . ":</b> " . hash(hash_algos()[$i],$pass) . "<br />";
    }
  }
}
 ?>

</body>
</html>
