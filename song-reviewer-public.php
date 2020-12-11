<?php
include 'data.php';
include 'helpers.php';

$dao = new DataAccessObject();
$selectedArtist = $artists[0];;
if (isset($_GET['artistName'])) {
    $selectedArtist = $_GET['artistName'];
}
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
    $errorMessage = null;
    $login = $_POST["login"];
    $password = $_POST["password"];
    $foundedReviewer = $dao->findReviewer($login);
    if ($foundedReviewer != null) {
        if ($password == $foundedReviewer['password']) {
            session_start();
            $_SESSION["reviewer"] = $foundedReviewer;
            $_SESSION["selectedArtist"] = $selectedArtist;
            Redirect($project_path . "song-reviewer-private.php?user=$login");
        } else {
            $errorMessage = "Wrong password!";
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
<section>
    <h3>Filters:</h3>
    <form id="reviewsFilterForm" name="reviewsFilterForm" method="get" autocomplete="on">
        <p>
            <label>Artist:
                <select name="artistName" autocomplete="on">
                    <?php
                    for ($i = 0; $i < count($artists); $i++) {
                        $artist = $artists[$i];
                        $isSelected = boolval($artist == $selectedArtist);
                        $nr = $i + 1;
                        ?>
                        <option value="<?php echo $artist ?>"
                            <?php if ($isSelected) {
                                echo " selected";
                            } ?>>
                            <?php echo "$nr.) $artist" ?>
                        </option>
                    <?php } ?>
                </select>
            </label>
        </p>
        <p>
            <input type="submit" name="refresh" value="Refresh"/>
        </p>
    </form>
</section>
<section><h3>Song reviews:</h3></section>

<?php

foreach ($dao->findAllReviews($selectedArtist) as $songReview) {
    $song = $songReview['song'];
    $reviewer = $songReview["reviewer"];
    ?>
    <section style="cursor: pointer;">
        <h3><?php echo $song["name"] ?></h3>
        <p><strong>Artist: </strong><?php echo $song["artist"] ?></p>
        <p><strong>Album: </strong><?php echo $song["album"] ?></p>
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
