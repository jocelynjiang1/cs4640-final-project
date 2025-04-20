<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="author" content="Jocelyn Jiang and Jennifer Liu">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <title>Hobby Tracker Home</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link 
    href="https://fonts.googleapis.com/css2?family=Architects+Daughter&display=swap" 
    rel="stylesheet"
  >
  <link rel="stylesheet" href="style/home.css">
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
    <section class="favorite-hobby">
      <h2>Favorite Hobby: Watching Movies</h2>
      <p class="hobby-description">I really enjoy watching movies! My latest movie watched was Captain America: Brave New World!</p>

      <div class="hobby-details">
        <div class="hobby-image">
          <div class="img-placeholder">
            <img src="movie.jpg" alt="Captain America Movie" width="175" height="175">
          </div>
        </div>

        <div class="stats">
          <div class="stat-box">
            <h3>100+</h3>
            <p>hours spent</p>
          </div>
          <div class="stat-box">
            <h3>200+</h3>
            <p>movies rated</p>
          </div>
          <div class="stat-box">
            <h3>90+</h3>
            <p>movies watched</p>
          </div>
          <div class="stat-box">
            <h3>20+</h3>
            <p>5 star reviews</p>
          </div>
        </div>
      </div>
    </section>
    <section class="other-hobbies">
      <h2>Other Hobbies</h2>
      <p class="other-hobbies-description col-9">
        Some of my other hobbies include... (short description?)
      </p>

      <div class="hobby-cards">  
        <?php 
          for($i=0;$i<count($hobbies);$i++){
            $hobby = $hobbies[$i];
            $hobby_name = $hobby["hobby_name"];
            $hobby_description = $hobby["hobby_description"];
            $hobby_id = $hobby["id"];
            echo 
            "<form action='?command=hobby_page' method='post'>
              <input type='hidden' name='hobby_id' value='$hobby_id'>
              <button type='submit'>
                <div class='card add-hobby-card'>
                <h3>$hobby_name</h3>
                <p>
                    $hobby_description
                </p>
                </div>
              </button>
            </form>";
          }
        ?>
        <form action="?command=showAddHobby" method="post">
          <button type="submit">
          <div class="card add-hobby-card">
            <h3>Add Hobby</h3>
            <p>Add a new hobby to your home page!</p>
          </div>
          </button>
        </form>
      </div>
    </section>
  </main>
  <footer>
    <p>
      &copy; 2024 Website. All rights reserved. This is a Class Project! 
    </p>
  </footer>
  </body>
</html>