<?php
include 'data.php';
include 'helpers.php';

session_start();

$login = $_SESSION["login"];
$userId = $_SESSION["userId"];
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
<head>
    <title>Song reviewer</title>
    <meta charset="UTF-8">
    <meta name="keywords" content="Log, Logging">
    <link rel="stylesheet" type="text/css" href="song-reviewer.css">
    <script type="text/javascript" src="song-reviewer-alerts.js"></script>
</head>
<body onload="loadWebsite()">
<header>Song Reviewer</header>
<section>
    <h3>Welcome <?php echo $login ?> !
        <button id="showCookiesButton">Show cookies</button>
        <button id="logOutButton">Log out</button>
    </h3>
</section><?php
if (isset($_POST['submit'])) { ?>
    <div id="formAlert">
        <div class="alert" style="background-color: #0e9b0e;">
            <span id="formAlertCloseBtn" class="closebtn">&times;</span>
            Review nr. <?php echo count($songReviews) + count($_SESSION['songReviews']) + 1 ?> was added !
        </div>
    </div>
    <?php
    array_push($_SESSION['songReviews'], createSongReview($_POST, $userId));
}
?>
<section>
    <h3><?php echo FORM_TITLE ?></h3>
    <form id="addNewReviewForm" name="newReviewForm" method="post" autocomplete="on">
        <p>
            <label>Artist:
                <select name="artistName" autocomplete="on">
                    <?php
                    for ($i = 0; $i < count($artists); $i++) {
                        $artist = $artists[$i];
                        $nr = $i + 1;
                        ?>
                        <option value="<?php echo $artist ?>">
                            <?php echo "$nr.) $artist" ?>
                        </option>
                    <?php } ?>
                </select>
            </label>
        </p>
        <p>
            <label>Song name <input name="songName" type="text" minlength="2" maxlength="40" placeholder="Song name"
                                    required/></label>
        </p>
        <p>
            <label>Album <input name="albumName" type="text" minlength="2" maxlength="40"
                                placeholder="Album name"/></label>
        </p>

        <p>
            <label>Review <textarea name="review" rows="10" cols="30" placeholder="It blew me away !!"
                                    required></textarea></label>
        </p>
        <p>
        <p>
            <input type="submit" name="submit" value="Create review"/>
            <input type="reset" onclick="resetReview()" value="Clear"/>
        </p>
    </form>
</section>
<?php foreach (array_merge($songReviews, $_SESSION['songReviews']) as $songReview) {
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