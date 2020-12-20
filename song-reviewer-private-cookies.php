<?php
include 'data.php';
include 'helpers.php';

session_start();
$login = $_SESSION["login"];
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
<head>
    <title>Song reviewer</title>
    <meta charset="UTF-8">
    <meta name="keywords" content="Log, Logging">
    <?php
    setStyle();
    ?>
    <script type="text/javascript" src="song-reviewer-alerts.js"></script>
</head>
<body onload="loadWebsite()">
<header>Song Reviewer</header>
<section>
    <h3>Welcome <?php echo $login ?> !
        <button id="logOutButton">Log out</button>
    </h3>
</section>
<section>
    <h3>Cookies:</h3>
    <?php foreach ($_COOKIE as $cookieName => $cookieValue) { ?>
        <p><strong><?php echo $cookieName ?>: </strong><?php echo $cookieValue ?></p>
    <?php } ?>
</section>
<section>
    <h3>Session variables:</h3>
    <?php foreach ($_SESSION as $name => $value) {
        $valueToDisplay = is_array($value) ? print_r($value, true) : $value;
        ?>
        <p><strong><?php echo $name ?>: </strong><?php echo $valueToDisplay ?></p>
    <?php } ?>
</section>
<section>
  <form action="POST" id="usersFilters">
  <h3>Available filters:</h3>
  <p>

  </p>
  <p>
    <input type="radio" name="is_female" value="true" checked>
    Female
    <input type="radio" name="is_female" value="false">Male
  </p>
  <input type="submit" name="useFilters" value="Apply filters">
  <br>
  </form>
  <h3>Found users:</h3>
  <p>
    <?php

      $dao = new DataAccessObject;

      $users = (isset($_POST["useFilters"]))? $dao->findMatchingUsers($filters) : $dao->findAllUsers();
      foreach($dao->findMatchingUsers("") as $user){
        print("<section>");
        foreach($user as $col => $val){
          print("<p>$col : $val </p>");
        }
        print("</section>");
      }
    ?>
  </p>
</section>
<footer>
    Song Reviewer 2020 &trade;
</footer>
</body>
</html>
