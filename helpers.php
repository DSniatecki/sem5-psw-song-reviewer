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

?>