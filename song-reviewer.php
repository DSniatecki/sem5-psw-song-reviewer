<?php
include 'data.php';

$songArtists = array();
$i = 0;

while ($i < count($artists)) {
    $currentArtist = current($artists);
    array_push($songArtists, $currentArtist);
    next($artists);
    $i = $i + 1;
}
reset($artists);

function createSongReview(array $rawSongReview)
{
    return array(
        "song" => array(
            "name" => $rawSongReview['songName'],
            "artist" => $rawSongReview['artistName'],
            "album" => $rawSongReview['albumName'],
        ),
        "reviewer" => array(
            "nickname" => $rawSongReview['reviewerNickname'],
            "email" => $rawSongReview['reviewerEmail'],
            "isFemale" => $rawSongReview['isFemale']
        ),
        "review" => $rawSongReview['review']
    );
}


?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
<head>
    <title>Song reviewer</title>
    <meta charset="UTF-8">
    <meta name="keywords" content="Log, Logging">
    <meta name="authors" content="Damian Śniatecki, Daniel Eryk Wojciechowski">
    <link rel="stylesheet" type="text/css" href="song-reviewer.css">
    <script type="text/javascript" src="song-reviewer-alerts.js"></script>
</head>
<body onload="loadWebsite()">
<header>Song Reviewer</header>
<?php
if (isset($_POST['submit'])) {
    if (strtolower($_POST["songName"]) == "die") {
        die('<div class="die"><strong>I am dying...</strong></div>');
    }
    $reviewerEmail = $_POST["reviewerEmail"];
    if (!preg_match(EMAIL_REGEXP, $reviewerEmail)) { ?>
        <div id="formAlert">
            <div class="alert" style="background-color: red;">
                <span id="formAlertCloseBtn" class="closebtn">&times;</span>
                <?php echo "{$_SERVER['REMOTE_ADDR']} - Wrong email!"; ?>
            </div>
        </div>
        <?php
    } else {
        ?>
        <div id="formAlert">
            <div class="alert" style="background-color: #0e9b0e;">
                <span id="formAlertCloseBtn" class="closebtn">&times;</span>
                Review nr. <?php echo count($songReviews) + 1 ?> was added !
            </div>
        </div>
        <?php
        array_push($songReviews, createSongReview($_POST));
    }
}
?>
<section>
    <h3><?php echo FORM_TITLE ?></h3>
    <form id="addNewReviewForm" name="newReviewForm" method="post" autocomplete="on">
        <p>
            <label>Artist:
                <select name="artistName" autocomplete="on">
                    <?php
                    for ($i = 0; $i < count($songArtists); $i++) {
                        $artist = $songArtists[$i];
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
        <p><label>Your nickname <input name="reviewerNickname" type="text" minlength="2" maxlength="40"
                                       placeholder="Your nickname" required/></label>
        </p>
        <p>
            <label>Your email <input name="reviewerEmail" type="text" placeholder="reviewer@domain.com"
                                     required></label>
        </p>
        <p> Gender:
            <label for="louie"> Female <input type="radio" name="isFemale" value="true"></label>
            <label for="louie"> Male <input type="radio" name="isFemale" value="false"></label>
        </p>

        <p>
            <input type="submit" name="submit" value="Create review"/>
            <input type="reset" onclick="resetReview()" value="Clear"/>
        </p>


    </form>
</section>
<?php foreach ($songReviews as $songReview) { ?>
    <section style="cursor: pointer;">
        <h3><?php echo $songReview["song"]["name"] ?></h3>
        <p><strong>Artist: </strong><?php echo $songReview["song"]["artist"] ?></p>
        <p><strong>Album: </strong><?php echo $songReview["song"]["album"] ?></p>
        <p><strong>Review: </strong><?php echo $songReview["review"] ?></p>
        <p><strong>Reviewer: </strong><?php
            echo $songReview["reviewer"]["isFemale"] ? "Ms. " : "Mr. ";
            echo $songReview["reviewer"]["nickname"] ?></p>
        <p><strong>Reviewer email: </strong><?php echo $songReview["reviewer"]["email"] ?></p>
    </section>
<?php } ?>
<footer>
    Song Reviewer 2020 &trade;
</footer>
</body>
</html>