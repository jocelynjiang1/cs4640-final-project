<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
  <meta name="author" content="Jennifer Liu">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Edit Hobby</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link 
    href="https://fonts.googleapis.com/css2?family=Architects+Daughter&display=swap" 
    rel="stylesheet"
  >
  <link rel="stylesheet" href="style/home.css">
  <link rel="stylesheet" href="style/add_view_hobby.css">

  <script>
    function validateUpdate(){
      var hobby_name = document.getElementById("hobby-name").value;
      if(hobby_name==""){
        let msg = document.getElementById("message");
        msg.innerHTML = "Hobby name is required!";
        return false;
      }
    }
    function validateDelete(){
      
    }
  </script>
</head>
<body>
  <header>
    <nav class="navbar">
      <ul>
        <li>
          <form action="?command=home" method="post">
            <button type="submit">Home</button>
          </form>
        </li>
        <li><a href="#">Hobbies</a></li>
        <li><a href="#">Friends</a></li>
        <li class="logo">HOBOTRACK</li>
        <li><a href="#">Search</a></li>
        <li><a href="#">Profile</a></li>
        <li>
          <form action="?command=login" method="post">
            <button type="submit">Logout</button>
          </form>
        </li>
      </ul>
    </nav>
  </header>
  <main>
    <section class="edit-hobby">
      <h2>Edit Hobby</h2>

      <p id="message"></p>
      <?php if (isset($_GET["error"])) { ?>
        <p class="error"><?= htmlspecialchars($_GET["error"]) ?></p>
      <?php } ?>
      
      <form onsubmit="return validateUpdate();" action="" method="post">
        <input type="hidden" name="hobby_id" value="<?= htmlspecialchars($hobby_id) ?>">
        <label for="hobby-name">Hobby Name:</label>
        <input type="text" name="hobby-name" id="hobby-name" value="<?= htmlspecialchars($hobby_name) ?>">
        <br>
        <label for="hobby-description">Hobby Description:</label>
        <textarea name="hobby-description" id="hobby-description"><?= htmlspecialchars($hobby_description) ?></textarea>
        <br>
        <button type="submit">Update Hobby</button>
      </form>
      <form onsubmit="return validateDelete();" action="?command=deleteHobby" method="post" onsubmit="return confirm('Are you sure you want to delete this hobby? This action cannot be undone.');">
        <input type="hidden" name="hobby_id" value="<?= htmlspecialchars($hobby_id) ?>">
        <button type="submit">Delete Hobby</button>
      </form>
    </section>
  </main>
  <footer>
    <p>&copy; 2024 Website. All rights reserved. This is a Class Project!</p>
  </footer>
</body>
</html>
