<?php

define("FORM_TITLE", "Add new song!");
define("EMAIL_REGEXP", "/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+.[a-zA-Z0-9-.]+$/");
define("WEEK", 60 * 60 * 24 * 7);
define("FORBIDDEN_USER_CHARS_REGEXP", "/[\^<,\"@\/\{\}\(\)\*\$%\?=>:\|;#]+/i");


//Change path to your owns, so the sites work properly
$project_path = "";

$artists = array(
    "Arctic Monkeys",
    "Linkin Park",
    "Eminem"
);

$song_types = array("Rock",
    "Pop",
    "Electronic",
    "Cacophony",
    "Rap",
    "Trap",
    "Other"
);

$styles = array(
    "default" => "song-reviewer.css",
    "dark" => "song-reviewer-dark.css",
    "funky" => "song-reviewer-funky.css"
);

?>
