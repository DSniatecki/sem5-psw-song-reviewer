<?php
session_start();
include 'data.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Choose your style!</title>
    <meta charset="UTF-8">
    <meta name="keywords" content="Style, Adjust, Change">
    <meta name="authors" content="Damian Śniatecki, Jan Wantuła">
    <?php
    include 'helpers.php';
    setStyle();
    ?>
</head>

<body>
<header>Choose your own style!</header>
  <section>
    <p>
      <?php
      if (isset($_POST['setSelected'])){
        setcookie('userStyle', $_POST['chosenStyle'], time() + WEEK);
        redirect($project_path . "song-reviewer-private.php");
      }
      if (isset($_POST['preview'])){
        $style = $styles[$_POST["chosenStyle"]];
        print("<link rel=\"stylesheet\" type=\"text/css\" href=$style>");
      }
      ?>
    </p>
    <form name ="changeStyleForm" method="post">
      <p>
        <label>Choose your style:
          <select name = "chosenStyle">
            <?php


            foreach ($styles as $style=>$x){
                  print("<option value = \"$style\">");
                  print("$style");
                  print("</option>");
             }

             ?>
          </select>

        </label>
      </p>
      <input type="submit" name = "preview" value = "Show me how it looks!">
      <input type="submit" name = "setSelected" value = "Set this style for me!">
    </form>
  </section>
</body>
</html>
