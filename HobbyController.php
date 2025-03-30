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
      case "answer":
        $this->answerWord();
        break;
      case "showLetters":
        $this->showLetters();
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


  public function showWelcome($message = "") {
    include("/opt/src/cs4640-final-project/templates/index.html");
  }

  public function login(){
      if (isset($_POST["email"]) && isset($_POST["password"]) && !empty($_POST["email"]) && !empty($_POST["password"])) {
        $_SESSION["email"] = $_POST["email"];

        header("Location: ?command=home");
        return;
      }
      else{
        $message = "<p> Your email or password is missing! </p>";
      }

    $this->showWelcome($message); //if login failed (else statement executed), remain on welcome.php
  }
  public function home(){
    include("/opt/src/cs4640-final-project/templates/home.html");
  }
}