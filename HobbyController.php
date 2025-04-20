<?php
require_once __DIR__ . '/Config.php';
require_once __DIR__ . '/Database.php';
class HobbyController
{

  private $db;

  private $errorMessage = "";

  /**
   * Constructor
   */
  public function __construct($input)
  {
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
  public function run()
  {
    // Get the command
    $command = "welcome";
    if (isset($this->input["command"]) && ($this->input["command"] == "login" || isset($_SESSION["email"]))) { //a command passed in (isset, not empty) && logged in
      $command = $this->input["command"];
    }

    switch ($command) {
      case "login":
        $this->login();
        break;
      case "home":
        $this->home();
        break;
      case "hobby_page":
        $this->hobby_page();
        break;
      case "showAddHobby":
        $this->showAddHobby();
        break;
      case "createHobby":
        $this->createHobby();
        break;
      case "editHobby":
        $this->editHobby();
        break;
      case "updateHobby":
        $this->updateHobby();
        break;
      case "deleteHobby":
        $this->deleteHobby();
        break;
      case "createHobbyEntry":
        $this->createHobbyEntry();
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

  public function showWelcome($message = "")
  {
    include("templates/index.php");
  }

  public function login()
  {
    if (
      isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["username"]) &&
      !empty($_POST["email"]) && !empty($_POST["password"]) && !empty($_POST["username"])
    ) 
    {
      $name = trim($_POST['username']);
      $email = trim($_POST['email']);
      $password = trim($_POST['password']);
      $db = new Database();
      $check_exists = $db->query("select * from hobby_users where email = $1;", $_POST["email"]);
      if ($check_exists === false || empty($check_exists)) {
        $email_pattern = "/[A-Za-z]+@[A-Za-z]+.[A-Za-z]+/";
        $password_pattern = "/^[^\s]+$/"; //pwd can be any non-whitespace chars
        if ((preg_match($email_pattern, $email)) && (preg_match($password_pattern, $password))) {
          $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
          $result = $db->query(
            "INSERT INTO hobby_users (name, email, password) VALUES ($1, $2, $3)",
            $name,
            $email,
            $hashedPassword
          );
          $_SESSION["username"] = $_POST["username"];
          $_SESSION["email"] = $_POST["email"];
          $new_user = $db->query("select * from hobby_users where email = $1;", $_POST["email"]);
          $_SESSION["user_id"] = $new_user[0]["id"]; //makes easier to query hobbies table later
          header("Location: ?command=home");
          return;
        } else {
          $message = "Please check your email and password for correct format.";
        }
      } else { //user already in db
        $hashed_password = $check_exists[0]["password"];
        $correct = password_verify($_POST["password"], $hashed_password);
        if ($correct) {
          $_SESSION["username"] = $_POST["username"];
          $_SESSION["email"] = $_POST["email"];
          $new_user = $db->query("select * from hobby_users where email = $1;", $_POST["email"]);
          $_SESSION["user_id"] = $new_user[0]["id"];
          header("Location: ?command=home");
          return;
        } else { //incorrect pwd
          $message = "Your password does not match.";
        }
      }
    } else {
      $message = "Your email or password is missing.";
    }

    $this->showWelcome($message); //if login failed (else statement executed), remain on welcome.php
  }

  public function home()
  {
    $hobbies = $this->db->query("select * from hobbies where user_id = $1;", $_SESSION["user_id"]);
    include("templates/home.php");
  }

  public function showAddHobby($message = "")
  {
    include("templates/add_hobby.php");
  }
  public function createHobby()
  {
    if (isset($_POST["hobby-name"]) && !empty($_POST["hobby-name"])) {
      $hobby_description = "";
      if (isset($_POST["hobby-description"]) && !empty($_POST["hobby-description"])) {
        $hobby_description = $_POST["hobby-description"];
      }
      $this->db->query("insert into hobbies (user_id, hobby_name, hobby_description) values ($1,$2,$3);", $_SESSION["user_id"], $_POST["hobby-name"], $_POST["hobby-description"]);
      header("Location: ?command=home");
      return;
    } else {
      $message = "In the back end. ";
      $message = $message . "Please enter a name for your new hobby.";
    }
    $this->showAddHobby($message);
  }

  public function editHobby() {
    $hobby_id = isset($_GET["hobby_id"]) ? $_GET["hobby_id"] : (isset($_POST["hobby_id"]) ? $_POST["hobby_id"] : null);
    if (!$hobby_id) {
      die("Hobby ID is required.");
    }
  
    $hobby_info = $this->db->query(
      "SELECT hobby_name, hobby_description FROM hobbies WHERE id = $1 AND user_id = $2;",
      $hobby_id,
      $_SESSION["user_id"]
    );
  
    if (empty($hobby_info)) {
      die("Hobby not found or you are not authorized to edit it.");
    }
  
    $hobby_name = $hobby_info[0]["hobby_name"];
    $hobby_description = $hobby_info[0]["hobby_description"];
  
    include("templates/edit_hobby.php");
  }

  public function updateHobby() {
    if (isset($_POST["hobby_id"], $_POST["hobby-name"]) && !empty($_POST["hobby-name"])) {
      $hobby_id = $_POST["hobby_id"];
      $hobby_name = $_POST["hobby-name"];
      $hobby_description = isset($_POST["hobby-description"]) ? $_POST["hobby-description"] : "";
  
      $this->db->query(
        "UPDATE hobbies SET hobby_name = $1, hobby_description = $2 WHERE id = $3 AND user_id = $4;",
        $hobby_name,
        $hobby_description,
        $hobby_id,
        $_SESSION["user_id"]
      );
      header("Location: ?command=hobby_page&hobby_id=" . $hobby_id); //go to hobby page by id
      return;
    } else {
      $message = "Hobby name is required.";
      header("Location: ?command=editHobby&hobby_id=" . $_POST["hobby_id"] . "&error=" . urlencode($message));
      return;
    }
  }
  
  public function deleteHobby() {
    $hobby_id = isset($_GET["hobby_id"]) ? $_GET["hobby_id"] : (isset($_POST["hobby_id"]) ? $_POST["hobby_id"] : null);
    if (!$hobby_id) {
      die("Hobby ID is required for deletion.");
    }
  
    // delete sql statements
    $this->db->query("DELETE FROM hobbies WHERE id = $1 AND user_id = $2;", $hobby_id, $_SESSION["user_id"]);
    
    $this->db->query("DELETE FROM hobby_entries WHERE hobby_id = $1;", $hobby_id);
    
    header("Location: ?command=home");
    return;
  }
  

  public function hobby_page() {
    $hobby_id = isset($_POST["hobby_id"]) ? $_POST["hobby_id"] : $_GET["hobby_id"];
    if (!$hobby_id) {
      die("Hobby ID is required.");
    }
  
    $hobby_info = $this->db->query("SELECT hobby_name, hobby_description FROM hobbies WHERE id = $1;", $hobby_id);
    if (empty($hobby_info)) {
      die("Hobby not found.");
    }
    $hobby_name = $hobby_info[0]["hobby_name"];
    $hobby_description = $hobby_info[0]["hobby_description"];
  
    $entries = $this->db->query(
      "SELECT entry_text, created_at FROM hobby_entries WHERE hobby_id = $1 ORDER BY created_at DESC;",
      $hobby_id
    );
  
    //json format
    if (isset($_GET["format"]) && $_GET["format"] === "json") {
      header('Content-Type: application/json');
      echo json_encode([
        "hobby" => [
          "id"          => $hobby_id,
          "name"        => $hobby_name,
          "description" => $hobby_description,
        ],
        "entries" => $entries
      ]);
      return;
    }
  
    include("templates/hobby_page.php");
  }
  
  // creating hobby entry
  public function createHobbyEntry() {
    if (
      isset($_POST["entry_text"], $_POST["hobby_id"]) &&
      !empty($_POST["entry_text"]) &&
      !empty($_POST["hobby_id"])
    ) {
      $entry_text = $_POST["entry_text"];
      $hobby_id = $_POST["hobby_id"];
      $this->db->query(
        "INSERT INTO hobby_entries (hobby_id, entry_text) VALUES ($1, $2);",
        $hobby_id,
        $entry_text
      );
      header("Location: ?command=hobby_page&hobby_id=" . $hobby_id);
      return;
    } else {
      $message = "Please enter some text for your new entry.";
      header("Location: ?command=hobby_page&hobby_id=" . $_POST["hobby_id"] . "&error=" . urlencode($message));
      return;
    }
  }

  public function logout()
  {
    session_destroy();
  }

}