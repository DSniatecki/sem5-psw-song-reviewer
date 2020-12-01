<?php
include 'data.php';
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
<head>
    <title>Song reviewer</title>
    <meta charset="UTF-8">
    <meta name="keywords" content="Log, Logging">
    <meta name="authors" content="Damian Śniatecki, Daniel Eryk Wojciechowski">
    <link rel="stylesheet" type="text/css" href="song-reviewer.css">
    <script type="text/javascript" src="song-reviewer.js"></script>
    <script type="text/javascript" src="song-reviewer-alerts.js"></script>
</head>
<body>
<header>Song Reviewer</header>
<div id="alert"></div>
<?php
if (isset($_POST['submit'])) {
    $newSongReview = array(
        "song" => array(
            "name" => $_POST['songName'],
            "artist" => $_POST['artistName'],
            "youtubeUrl" => $_POST['songYoutubeUrl'],
            "album" => $_POST['albumName'],
        ),
        "reviewer" => array(
            "nickname" => $_POST['reviewerNickname'],
            "email" => $_POST['reviewerEmail']
        ),
        "review" => $_POST['review']
    );
    array_push($songReviews, $newSongReview);
}
?>
<section>
    <h3><?php echo FORM_TITLE ?></h3>
    <form id="addNewReviewForm" name="newReviewForm" method="post" autocomplete="on">
        <p>
            <label>Song name <input name="songName" type="text" minlength="2" maxlength="40" placeholder="Song name"
                                    required/></label>
        <p>
        <p>
            <label>Artist <input name="artistName" type="text" minlength="1" maxlength="40" placeholder="Artist name"
                                 required/></label>
        <p>
        <p>
            <label>Youtube link <input name="songYoutubeUrl" type="url" minlength="5" maxlength="500"
                                       placeholder="http://songcover.com" required/></label>
        <p>
        <p>
            <label>Album <input name="albumName" type="text" minlength="2" maxlength="40"
                                placeholder="Album name"/></label>
        <p>
        <p>
            <label>Review <textarea name="review" rows="10" cols="30" placeholder="It blew me away !!"
                                    required></textarea></label>
        </p>
        <p>
        <p><label>Your nickname <input name="reviewerNickname" type="text" minlength="2" maxlength="40"
                                       placeholder="Your nickname" required/></label>
        <p>
            <label>Your email <input name="reviewerEmail" type="email" placeholder="reviewer@domain.com"
                                     required></label></p>
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
        <p><strong>Nickname: </strong><?php echo $songReview["reviewer"]["nickname"] ?></p>
        <p><strong>Reviewer email: </strong><?php echo $songReview["reviewer"]["email"] ?></p>
    </section>
<?php } ?>
<footer>
    Song Reviewer 2020 &trade;
</footer>
</body>
</html>