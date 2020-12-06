<!DOCTYPE html>
<html>
<head>
    <title>Concert reviewer</title>
    <meta charset="UTF-8">
    <meta name="keywords" content="Concert, Reviews">
    <meta name="authors" content="Damian Śniatecki, Jan Wantuła">
    <link rel="stylesheet" type="text/css" href="song-reviewer.css">
    <script type="text/javascript" src="song-reviewer-alerts.js"></script>
</head>

<body>
<header>Concert reviewer</header>
  <section>
    <form id ="addConcertReviewForm" name ="newConcertForm" method="get" action="sent.php">
      <p>
        <label>Music type:
          <select name = "musicType">
            <?php
            include 'data.php';

            for ($i = 0; $i < count($song_types) ; $i++){
                  print("<option value = \"$song_types[$i]\">");
                  print("$song_types[$i]");
                  print("</option>");
             } ?>
          </select>
        </label>
      </p>

      <p>
        <label>Artist:
          <input name="artistName" type="text" placeholder="Input artist"/>
        </label>
      </p>
      <p>
          <label>Your review:<textarea name="review" rows="10" cols="30"
            placeholder="It was splendid!!!"></textarea>
          </label>
      </p>

      <p>
        <label>When did the concert take place?:
          <input name="concertDate" type="date"/>
        </label>
      </p>

      <p>
        <label>Your nickname:
          <input name="reviewerNickname" type="text"  placeholder="Your nickname" value="one"/>
        </label>
      </p>

      <p>
          <input type="submit" name="submit" value="Create review"/>
          <input type="reset" value="Clear"/>
      </p>
    </form>
  </section>
</body>
</html>
