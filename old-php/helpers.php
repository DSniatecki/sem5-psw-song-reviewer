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

    function addNewUser($newUser)
    {
      $dbConnection = pg_connect($this->connectionString);
      $rawUser = "('${newUser['login']}', '${newUser['email']}', '${newUser['password']}', '${newUser['is_female']}')";
      $query = "INSERT INTO reviewers(login, email, password, is_female) VALUES $rawUser;";
      $result = pg_query($dbConnection, $query);
      pg_close($dbConnection);
      $error = pg_result_error($result);
      if ($error) {
          die("Connection with DB failed:  $error");
      }
    }

    function updateUser($currentUser, $newData){
      $dbConnection = pg_connect($this->connectionString);

      $result = pg_update($dbConnection, 'reviewers',$newData, array('login' => "${currentUser['login']}"));

      pg_close($dbConnection);
      $error = pg_result_error($result);
      if ($error) {
          die("Connection with DB failed:  $error");
      }
    }

    function findAllUsers()
    {
      $dbConnection = pg_connect($this->connectionString);
      $usersQueryResult = pg_query($dbConnection, "SELECT * FROM reviewers;");
      $error = pg_result_error($usersQueryResult);
      if ($error) {
          die("Connection with DB failed:  $error");
      }
      $users = array();
      while ($usersRow = pg_fetch_assoc($usersQueryResult)) {
          $user = array(
              "login" => $usersRow["login"],
              "id" => $usersRow["id"],
              "password" => $usersRow["password"],
              "email" => $usersRow["email"],
              "is_female" => $usersRow["is_female"]
          );
          array_push($users, $user);
      }
      pg_close($dbConnection);
      return $users;
    }

    function findMatchingUsers($condition)
    {
      $dbConnection = pg_connect($this->connectionString);
      $usersQueryResult = pg_query($dbConnection, "SELECT * FROM reviewers WHERE $condition;");
      $error = pg_result_error($usersQueryResult);
      if ($error) {
          die("Connection with DB failed:  $error");
      }
      if (!$usersQueryResult){
        return NULL;
      }
      $users = array();
      while ($usersRow = pg_fetch_assoc($usersQueryResult)) {
          $user = array(
              "login" => $usersRow["login"],
              "id" => $usersRow["id"],
              "password" => $usersRow["password"],
              "email" => $usersRow["email"],
              "is_female" => $usersRow["is_female"]
          );
          array_push($users, $user);
      }
      pg_close($dbConnection);
      return $users;
    }

    function extended_query($connection, $query){
      $queryResult = pg_query($connection, $query);
      $error = pg_result_error($queryResult);
      if ($error) {
          die("Connection with DB failed:  $error");
      }
    }

    function deleteDatabaseTables(){
      $dbConnection = pg_connect($this->connectionString);
      $this->extended_query($dbConnection, "DROP TABLE IF EXISTS reviews;");
      $this->extended_query($dbConnection, "DROP TABLE IF EXISTS reviewers;");
      pg_close($dbConnection);
    }

    function createDatabaseTables(){
      $dbConnection = pg_connect($this->connectionString);

      $this->extended_query($dbConnection,
        "CREATE TABLE reviewers
        (
            id        SERIAL PRIMARY KEY,
            login     VARCHAR(40) NOT NULL UNIQUE,
            email     VARCHAR(40) NOT NULL UNIQUE,
            password  VARCHAR(80) NOT NULL,
            is_female BOOLEAN     NOT NULL
        );"
      );

      $this->extended_query($dbConnection,
        "CREATE TABLE reviews
        (
            id          SERIAL,
            song        VARCHAR(120)  NOT NULL,
            artist      VARCHAR(80)   NOT NULL,
            album       VARCHAR(80),
            review      VARCHAR(1000) NOT NULL,
            reviewer_id INT,
            CONSTRAINT fk_reviewer FOREIGN KEY (reviewer_id) REFERENCES reviewers (id)
        );"
      );

      $this->insertSampleData($dbConnection);
      pg_close($dbConnection);
    }

    //Function meant to be used in createDatabaseTables() function
    private function insertSampleData($dbConnection){
      $this->extended_query($dbConnection,
        "INSERT INTO reviewers(login, email, password, is_female)
        VALUES ('Bartek', 'bartek@gmail.com', 'bartek', false),
               ('Agnieszka', 'agnieszka@gmail.com', 'agnieszka', true);"
      );
      $this->extended_query($dbConnection,
        "INSERT INTO reviews(song, artist, album, review, reviewer_id)
        VALUES ('505', 'Arctic Monkeys', 'Favourite Worst Nightmare',
                'Wherever they turn, irony dissolves and Turner, acting out lyrics like “I lost my train of thought” or “she held me very tightly” with am - dram theatricality, can’t help but be a real rock star even as he plays with the role . In the end, every side to the band – funk troupe, garage punks, aloof posers, heartfelt songwriters – coheres on the closing R U Mine ?, a diamond anthem that tightens and collapses at all the right moments . Now armed with what is essentially a greatest - hits set, Arctic Monkeys have become a band who can do everything – it might be a construct, but it feels so real',
                1),
               ('Do I wanna know', 'Arctic Monkeys', 'AM',
                'The band, bolstered by supporting players on keys and acoustic guitar, are immaculately drilled – sometimes too much so, as on Pretty Visitors, which hops around with math - rock fussiness, or She Looks Like Fun, which looks tremendously enjoyable for Cook but will surely not hang around their setlist for long . Much better is when their chops are transmuted into pure energy: Brianstorm, Don’t Sit Down ’Cause I’ve Moved Your Chair and View from the Afternoon swerve too fast through their corners and are all the better for it . The drummer Matt Helders, a mere timekeeper during the Tranquility Base material, is transformed into a dynamo; with a spotlight behind him, he becomes a tub - thumping Godzilla on the rear wall .',
                2),
               ('Fluorescent Adolescent', 'Arctic Monkeys', 'Favourite Worst Nightmare',
                'Wherever they turn, irony dissolves and Turner, acting out lyrics like “I lost my train of thought” or “she held me very tightly” with am - dram theatricality, can’t help but be a real rock star even as he plays with the role . In the end, every side to the band – funk troupe, garage punks, aloof posers, heartfelt songwriters – coheres on the closing R U Mine ?, a diamond anthem that tightens and collapses at all the right moments . Now armed with what is essentially a greatest - hits set, Arctic Monkeys have become a band who can do everything – it might be a construct, but it feels so real',
                1),
               ('Castle of glass', 'Linkin Park', 'Hybrid Theory',
                'Wherever they turn, irony dissolves and Turner, acting out lyrics like “I lost my train of thought” or “she held me very tightly” with am - dram theatricality, can’t help but be a real rock star even as he plays with the role . In the end, every side to the band – funk troupe, garage punks, aloof posers, heartfelt songwriters – coheres on the closing R U Mine ?, a diamond anthem that tightens and collapses at all the right moments . Now armed with what is essentially a greatest - hits set, Arctic Monkeys have become a band who can do everything – it might be a construct, but it feels so real',
                1),
               ('Numb', 'Linkin Park', 'Hybrid Theory',
                'In May of 2019, an anonymous outfit known only as SAULT released an album of tasteful soul - funk with a scratchy DIY veneer that sounded like an Instagram - filtered reunion of ESG . Biography - shy musicians that bring a retro sensibility to the music of late - 1970s, early - ’80s roller rinks and B - boys aren’t unusual, from the action - packed exuberance of the Go!Team in the 2000s to the falsetto - streaked brooding of Jungle in the last decade . SAULT, though, were unusually prolific, and they had something to say . With lyrics foregrounding Black identity, June’s UNTITLED(Black Is) seemed like a fitting soundtrack for this summer of collective action against police violence and systemic racism.',
                2),
               ('Lose yourself', 'Eminem', 'The Eminem Show',
                'The band, bolstered by supporting players on keys and acoustic guitar, are immaculately drilled – sometimes too much so, as on Pretty Visitors, which hops around with math - rock fussiness, or She Looks Like Fun, which looks tremendously enjoyable for Cook but will surely not hang around their setlist for long . Much better is when their chops are transmuted into pure energy: Brianstorm, Don’t Sit Down ’Cause I’ve Moved Your Chair and View from the Afternoon swerve too fast through their corners and are all the better for it . The drummer Matt Helders, a mere timekeeper during the Tranquility Base material, is transformed into a dynamo; with a spotlight behind him, he becomes a tub - thumping Godzilla on the rear wall .',
                2);"
      );
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

function printErrorMessage($msg){
  print("<p class=\"error\">$msg</p>");
}

?>
