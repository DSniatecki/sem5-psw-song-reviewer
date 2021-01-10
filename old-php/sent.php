<!DOCTYPE html>
<html>
<head>
    <title>Submit</title>
    <meta charset="UTF-8">
    <meta name="keywords" content="Thanks, Review, Concert">
    <meta name="authors" content="Damian Śniatecki, Jan Wantuła">
    <?php
    include 'helpers.php';
    setStyle();
    ?>
</head>

<body>
<header>Thanks for your review!</header>
  <section>
      <p>
        <?php
        $minimal_date = "2000-01-01";
        $given_date = $_GET["concertDate"];

        for (reset($_GET); $key = key($_GET) ; next($_GET)){
          if (strlen($_GET[$key]) < 1){
            print("In order to post your review, you need to enter all values!");
            die();
          }
        }

        if (strcmp($minimal_date, $given_date ) > 0){
            print("Wrong date! There were no concerts before " . $minimal_date);
            die();
        }



        print("<h3>Thanks for your review!</h3>");



        ?>
      </p>
  </section>
</body>
</html>
