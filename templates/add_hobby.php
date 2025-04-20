<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="author" content="Jocelyn Jiang">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Add New Hobby</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link 
    href="https://fonts.googleapis.com/css2?family=Architects+Daughter&display=swap" 
    rel="stylesheet"
  >
  <link rel="stylesheet" href="style/home.css">
  <link rel="stylesheet" href="style/add_view_hobby.css">

  <script>
    function validateHobby(){ //looked up prioritizing client handling before server; return false cancels form submission
      var hobby_name = document.getElementById("category-name").value;
      if (hobby_name==""){
        let msg = document.getElementById("message");
        msg.innerHTML = "Please enter a name for your new hobby!";
        return false;
      }
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
        <section class="category">
            <h2>Add a new hobby to your profile!</h2>
            <form onsubmit="return validateHobby();" action="?command=createHobby" method="post" id="hobby-form">
                <label for="category-name" class="category-name">New category name:</label>
                <input type="text" id="category-name" name="hobby-name"> <br>
                <label for="category-description" class="category-description">Category description (optional):</label>
                <input type="text" id="category-description" name="hobby-description"> <br>
                <button type="submit" name="submit-category" class="submit-category">Create category!</button>
            </form>
            <br>
            <p id="message"></p>
            <?=$message?> <!-- or should it be wrapped by p with id message? -->
        </section>
        
    </main>

    <div class="new-hobby-icons">
        <span class="icon icon-camera">📷</span>
        <span class="icon icon-paint">🖌️</span>
        <span class="icon icon-sewing">🧵</span>
        <span class="icon icon-mic">🎤</span>
        <span class="icon icon-cooking">🍳</span>
        <span class="icon icon-surf">🏄</span>
    </div>

    <footer>
        <p>
          &copy; 2024 Website. All rights reserved. This is a Class Project! 
        </p>
    </footer>

</body>
</html>