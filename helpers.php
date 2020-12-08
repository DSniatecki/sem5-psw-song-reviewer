<?php

function createSongReview(array $rawSongReview, $reviewerId)
{
    return array(
        "song" => array(
            "name" => $rawSongReview['songName'],
            "artist" => $rawSongReview['artistName'],
            "album" => $rawSongReview['albumName'],
        ),
        "reviewerId" => $reviewerId,
        "review" => $rawSongReview['review']
    );
}

function redirect($url)
{
    header('Location: ' . $url, true, 302);
    exit();
}

function setStyle()
{
  $styles = array(
    "default" => "song-reviewer.css",
    "dark" => "song-reviewer-dark.css",
    "funky" => "song-reviewer-funky.css"
  );

  $style = isset($_COOKIE["userStyle"]) ? $styles[$_COOKIE["userStyle"]] : $styles["default"];
  print("<link rel=\"stylesheet\" type=\"text/css\" href=$style>");
}

?>
