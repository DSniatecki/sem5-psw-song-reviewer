<?php
include 'data.php';
include 'helpers.php';

if (session_status() == PHP_SESSION_ACTIVE) {
    session_destroy();
}
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
<head>
    <title>Song reviewer</title>
    <meta charset="UTF-8">
    <meta name="keywords" content="Log, Logging">
    <link rel="stylesheet" type="text/css" href="song-reviewer.css">
</head>
<body>
<header>Song Reviewer</header>
<?php
if (isset($_POST['submit'])) {
    $login = $_POST["login"];
    $password = $_POST["password"];
    $errorMessage = null;
    foreach ($reviewers as $reviewer) {
        if ($login == $reviewer["login"]) {
            if ($password == $reviewer["password"]) {
                session_start();
                $_SESSION['songReviews'] = array();
                $_SESSION["login"] = $login;
                $_SESSION["userId"] = $reviewer["id"];
                Redirect($project_path . "song-reviewer-private.php?user=$login");
            } else {
                $errorMessage = "Wrong password!";
            }
        }
    }
    if ($errorMessage == null) {
        $errorMessage = "User: $login does not exist!";
    }
    ?>
    <div id="formAlert">
        <div class="alert" style="background-color: #de0404;">
            <span id="formAlertCloseBtn" class="closebtn">&times;</span>
            <?php echo $errorMessage ?>
        </div>
    </div>
<?php } ?>
<section>
    <h3>Sign in</h3>
    <form id="signInForm" name="signInForm" method="post" autocomplete="on">
        <p>
        <p><label>Login <input name="login" type="text" minlength="2" maxlength="40" placeholder="login"
                               required/></label>
        </p>
        <p>
            <label>Password <input name="password" type="password" minlength="6" maxlength="80" placeholder="password"
                                   required></label>
        </p>
        <p>
            <input type="submit" name="submit" value="Sign in"/>
            <input type="reset" value="Clear"/>
        </p>
    </form>
</section>
<section><h3>Song reviews:</h3></section>
<?php foreach ($songReviews as $songReview) {
    $reviewer = $reviewers[$songReview["reviewerId"]]
    ?>
    <section style="cursor: pointer;">
        <h3><?php echo $songReview["song"]["name"] ?></h3>
        <p><strong>Artist: </strong><?php echo $songReview["song"]["artist"] ?></p>
        <p><strong>Album: </strong><?php echo $songReview["song"]["album"] ?></p>
        <p><strong>Review: </strong><?php echo $songReview["review"] ?></p>
        <p><strong>Reviewer: </strong><?php
            echo $reviewer["isFemale"] ? "Ms. " : "Mr. ";
            echo $reviewer["login"] ?></p>
        <p><strong>Reviewer email: </strong><?php echo $reviewer["email"] ?></p>
    </section>
<?php } ?>
<footer>
    Song Reviewer 2020 &trade;
</footer>
</body>
</html>
