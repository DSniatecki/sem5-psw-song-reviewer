<?php

class DataAccessObject
{
    public $connectionString = "host=localhost port=5432 dbname=postgres user=postgres password=admin";

    function findReviewer($login)
    {
        $dbConnection = pg_connect($this->connectionString);
        $userQueryResult = pg_query($dbConnection, "SELECT id, login, email, password, is_female FROM reviewers WHERE login = '$login';");
        $error = pg_result_error($userQueryResult);
        if ($error) {
            die("Connection with DB failed:  $error");
        }
        if (($row = pg_fetch_row($userQueryResult)) != false) {
            pg_close($dbConnection);
            return array(
                "id" => $row[0],
                "login" => $row[1],
                "email" => $row[2],
                "password" => $row[3],
                "isFemale" => $row[4]
            );
        } else {
            pg_close($dbConnection);
            return null;
        }
    }


    function findAllReviews($artistName)
    {
        $dbConnection = pg_connect($this->connectionString);
        $reviewsQueryResult = pg_query($dbConnection, "SELECT song, artist, album, review, reviewer.id as reviewer_id, login, email, is_female FROM reviews as review JOIN reviewers reviewer on reviewer.id = review.reviewer_id WHERE artist = '$artistName';");
        $error = pg_result_error($reviewsQueryResult);
        if ($error) {
            die("Connection with DB failed:  $error");
        }
        $songReviews = array();
        while ($reviewRow = pg_fetch_assoc($reviewsQueryResult)) {
            $songReview = array(
                "song" => array(
                    "name" => $reviewRow['song'],
                    "artist" => $reviewRow['artist'],
                    "album" => $reviewRow['album'],
                ),
                "review" => $reviewRow['review'],
                "reviewer" => array(
                    "id" => $reviewRow['reviewer_id'],
                    "login" => $reviewRow['login'],
                    "email" => $reviewRow['email'],
                    "isFemale" => $reviewRow['is_female'],
                )
            );
            array_push($songReviews, $songReview);
        }
        pg_close($dbConnection);
        return $songReviews;
    }


    function addNewReview($newReview)
    {
        $dbConnection = pg_connect($this->connectionString);
        $song = $newReview['song'];
        $reviewer = $newReview['reviewer'];
        $rawReview = "('${song['name']}', '${song['artist']}', '${song['album']}', '${newReview['review']}', '${reviewer['id']}')";
        $query = "INSERT INTO reviews(song, artist, album, review, reviewer_id) VALUES $rawReview;";
        $result = pg_query($dbConnection, $query);
        pg_close($dbConnection);
        $error = pg_result_error($result);
        if ($error) {
            die("Connection with DB failed:  $error");
        }

    }

}

function createSongReview(array $rawSongReview, $reviewer)
{
    return array(
        "song" => array(
            "name" => $rawSongReview['songName'],
            "artist" => $rawSongReview['artistName'],
            "album" => $rawSongReview['albumName'],
        ),
        "reviewer" => $reviewer,
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
