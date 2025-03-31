<?php

class HobbyController {

  private $db;

  private $errorMessage = "";

  /**
   * Constructor
   */
  public function __construct($input) {
    // Start the session!
    session_start();

    $this->db = new Database();
    $this->input = $input;
  }

  /**
   * Run the server
   * 
   * Given the input (usually $_GET), then it will determine
   * which command to execute based on the given "command"
   * parameter.  Default is the welcome page.
   */
  public function run() {
    // Get the command
    $command = "welcome";
     
    if (isset($this->input["command"]) && ($this->input["command"] == "login" || isset($_SESSION["email"]))){ //a command passed in (isset, not empty) && logged in
      $command = $this->input["command"];
    }
    switch($command) {
      case "login": 
        $this->login();
        break;
      case "home":
        $this->home();
        break;
      case "example_hobby":
        $this->example_hobby();
        break;
      case "showAddHobby":
        $this->showAddHobby();
        break;
      case "createHobby":
        $this->createHobby();
        break;
      case "gameover":
        $this->gameover();
        break;
      case "logout": 
        $this->logout(); // notice no break 
      case "welcome":
      default:
        $this->showWelcome();
        break;
    }
  }

  // public function login() {
  //   if (isset($_POST["fullname"]) && isset($_POST["email"]) && isset($_POST["password"]) &&
  //     !empty($_POST["fullname"]) && !empty($_POST["email"]) && !empty($_POST["password"])) {

  //       $_SESSION["name"] = $_POST["fullname"];
  //       $_SESSION["email"] = $_POST["email"];
  //       $_SESSION["score"] = 0;
  //       $_SESSION["valid_guesses"] = [];
  //       $_SESSION["count_invalid"] = 0;
  //       $_SESSION["won"] = false;
  //       $_SESSION["letters"] = [];

  //       header("Location: ?command=showLetters");
  //       return;
  //     }
  //     else{
  //       $message = "<p> Your name or email is missing! </p>";
  //     }

  //   $this->showWelcome($message); //if login failed (else statement executed), remain on welcome.php
  // }


  public function showWelcome($message = "") {
    include("/opt/src/cs4640-final-project/templates/index.php");
  }

  public function login(){
      if (isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["username"]) && 
          !empty($_POST["email"]) && !empty($_POST["password"] && !empty($_POST["username"]))) {
          $check_exists = $this->db->query("select * from users where email = $1;",$_POST["email"]);

          if($check_exists===false || empty($check_exists)){
            $email_pattern = "/[A-Za-z]@[A-Za-z].[A-Za-z]/";
            if(preg_match($email_pattern,$_POST["email"])===1){
              $this->db->query("insert into users (name, email, password, fav_hobby_id) values ($1,$2,$3,$4)",
              $_POST["username"],$_POST["email"],password_hash($_POST["password"],PASSWORD_DEFAULT),NULL);
              
              $_SESSION["username"] = $_POST["username"];
              $_SESSION["email"] = $_POST["email"];
              $new_user = $this->db->query("select * from users where email = $1;",$_POST["email"]);
              $_SESSION["user_id"] = $new_user[0]["id"]; //makes easier to query hobbies table later
              header("Location: ?command=home");
              return;
            }
            else{
              $message = "Please enter a valid email.";
            }
          }
          else{ //user already in db
            $hashed_password = $check_exists[0]["password"];
            $correct = password_verify($_POST["password"], $hashed_password);
            if ($correct) {
              $_SESSION["username"] = $_POST["username"];
              $_SESSION["email"] = $_POST["email"];
              $new_user = $this->db->query("select * from users where email = $1;",$_POST["email"]);
              $_SESSION["user_id"] = $new_user[0]["id"];
    
              header("Location: ?command=home");
              return;
            }
            else{ //incorrect pwd
              $message = "Your password was incorrect!";
            }
          }
      }
      else{
        $message = "Your email or password is missing!";
      }

    $this->showWelcome($message); //if login failed (else statement executed), remain on welcome.php
}


  public function home(){
    $hobbies = $this->db->query("select * from hobbies where user_id = $1;",$_SESSION["user_id"]);
    include("/opt/src/cs4640-final-project/templates/home.php");
  }

  public function showAddHobby($message = ""){
    include("/opt/src/cs4640-final-project/templates/add_hobby.php");
  }
  public function createHobby(){
    if(isset($_POST["hobby-name"]) && !empty($_POST["hobby-name"]))
    {
      $hobby_description = "";
      if(isset($_POST["hobby-description"]) && !empty($_POST["hobby-description"])){
        $hobby_description = $_POST["hobby-description"];
      }
      $this->db->query("insert into hobbies (user_id, hobby_name, hobby_description) values ($1,$2,$3);",$_SESSION["user_id"],$_POST["hobby-name"],$_POST["hobby-description"]);
      header("Location: ?command=home");
      return;
    }
    else{
      $message="Please enter a name for your new hobby.";
    }
    $this->showAddHobby($message);
  }

  public function example_hobby(){
    include("/opt/src/cs4640-final-project/templates/example_hobby.php");
  }

    /**
   * Logout function.  We **need** to clear the session somehow.
   * When the user wants to start over, we should allow them to
   * reset the game.  I'll call it logout, so this function destroys
   * the session and immediately starts a new one.
   */
  public function logout() {
    // Destroy the session
    session_destroy();

    // Start a new session.  Why?  We want to show the next question.
    session_start();
  }

}