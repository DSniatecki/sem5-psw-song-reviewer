<?php
session_start();
include 'data.php';
include 'helpers.php';

$dao = new DataAccessObject();
$selectedArtist = $artists[0];;

$editingMode = isset($_SESSION["reviewer"]) ? true : false;
$userColumns = array("login","password","is_female","email");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Song reviewer</title>
    <meta charset="UTF-8">
    <meta name="keywords" content="Register, Registering, Schnitzel">
    <link rel="stylesheet" type="text/css" href="song-reviewer.css">
</head>
<body>
<header><?php echo $editingMode ? "Edit data": "Register" ; ?></header>
<?php
//Script checking posted values
$registerErrors = array("loginerror" => false,
"passworderror" => false, "emailerror" => false);

if (isset($_POST['submit'])) {
    $errorMessage = null;

    //Checking Login
    if (isset($_POST["login"])){
      $login = $_POST["login"];
      if ($dao->findReviewer($login) != null && $login != ""){
        $registerErrors["loginerror"] = true;
        $loginErrorMsg = "User with given login exists! Please input new one";
      }
      if (preg_match(FORBIDDEN_USER_CHARS_REGEXP, $login)){
        $registerErrors["loginerror"] = true;
        $loginErrorMsg = "Don't you dare SQL inject me! Please input new login";
      }
      if (strlen($login) < 2){
        $registerErrors["loginerror"] = true;
        $loginErrorMsg = "Login must be at least 2 characters long!";
      }
    }
    else{
      $registerErrors["loginerror"] = true;
      $loginErrorMsg = "Please input a login!";
    }

    //Checking password
    if (isset($_POST["password"])){
      $password = $_POST["password"];
      if (preg_match(FORBIDDEN_USER_CHARS_REGEXP, $password)){
        $registerErrors["passworderror"] = true;
        $passwordErrorMsg = "Don't you dare SQL inject me! Please input new password";
      }
      if (strlen($password) < 6 && $password!=""){
        $registerErrors["passworderror"] = true;
        $passwordErrorMsg = "Your new password needs to have at least 6 characters!";
      }
    }
    else {
      $registerErrors["passworderror"] = true;
      $passwordErrorMsg = "Please input password!";
    }

    //Checking email
    if (isset($_POST["email"])){
      $email = $_POST["email"];
      if (!preg_match(EMAIL_REGEXP, $email) && $email!=""){
        $registerErrors["emailerror"] = true;
        $emailErrorMsg = "Wrong email! Please input new one";
      }
    }
    else{
      $registerErrors["emailerror"] = true;
      $emailErrorMsg = "Please input email!";
    }

    $is_female = ($_POST["gender"] == "male") ? false : true;
    $errorExists = false;

    //Searching for errors
    foreach($registerErrors as $error){
      if ($error)
        $errorExists = true;
    }
    //If no error was found
    if (!$errorExists){
      $dao = new DataAccessObject();

      if(!$editingMode){
        $user = array("login" => $login, "password" => $password,
        "email" => $email, "is_female" => $is_female);
        $dao->addNewUser($user);
        redirect("song-reviewer-public.php");
      }

      if($editingMode){
        $newUserData = array();
        foreach($userColumns as $col){
          if ($$col != ""){
            $newUserData[$col] = $$col;
          }
          //It turns out that 'false' is equal to "" string (empty string)
          if ($col == "is_female"){
            $newUserData[$col] = $$col;
          }
        }
        $dao->updateUser($_SESSION["reviewer"], $newUserData);
        redirect("song-reviewer-private.php");
      }


    }//end of adding to database
    ?>
    <!-- Section for printing errors -->
    <div id="formAlert">
        <div class="alert" style="background-color: #de0404;">
            <span id="formAlertCloseBtn" class="closebtn">&times;</span>
            <?php foreach($registerErrors as $error => $exists){
              if ($exists){
                print("<p>$error is here!</p>");
              }
            }
            ?>
        </div>
    </div>
<?php }
//End of validating script!
//_____________________________________________________________
?>
<section>
    <h3><?php echo $editingMode ? "Edit data": "Register" ; ?> form</h3>
    <form id="registerForm" name="registerForm" method="post" autocomplete="off">
        <p>
          <?php
          if ($registerErrors["loginerror"]){
            printErrorMessage($loginErrorMsg);
          }
          ?>
          <label>Login <input name="login" type="text" <?php echo $editingMode ? "": "minlength=\"2\"" ; ?> maxlength="40" placeholder="login"
            <?php echo $editingMode ? "": "required" ; ?> /></label>
        </p>
        <p>
          <?php
          if ($registerErrors["emailerror"]){
            printErrorMessage($emailErrorMsg);
          }
          ?>
          <label>Email <input name="email" type="text" <?php echo $editingMode ? "": "minlength=\"2\"" ; ?> maxlength="40" placeholder="email"
            <?php echo $editingMode ? "": "required" ; ?>/></label>
        </p>
        <p>
          <?php
          if ($registerErrors["passworderror"]){
            printErrorMessage($passwordErrorMsg);
          }
          ?>
            <label>Password <input name="password" type="password" <?php echo $editingMode ? "": "minlength=\"6\"" ; ?> maxlength="80" placeholder="password"></label>
        </p>

          <label>I'm: Male
            <input type="radio" name="gender" value="male" checked>
            Female
            <input type="radio" name="gender" value="female"></p>
          </label>

        <p>
            <input type="submit" name="submit" value=<?php echo $editingMode ? '"Confirm edit"': '"Register"' ; ?>/>
            <input type="reset" value="Clear"/>
        </p>
    </form>
</section>


<footer>
    Song Reviewer 2020 &trade;
</footer>
</body>
</html>
