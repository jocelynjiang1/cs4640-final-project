<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="author" content="Jocelyn Jiang">
  <title>Add New Hobby</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link 
    href="https://fonts.googleapis.com/css2?family=Architects+Daughter&display=swap" 
    rel="stylesheet"
  >
  <link rel="stylesheet" href="style/home.css">
  <link rel="stylesheet" href="style/add_view_hobby.css">
  </head>

<body>
    <header>
        <nav class="navbar">
            <ul>
              <li><a href="home.html">Home</a></li>
              <li><a href="#">Hobbies</a></li>
              <li><a href="#">Friends</a></li>
              <li class="logo">HOBOTRACK</li>
              <li><a href="#">Search</a></li>
              <li><a href="#">Tracker</a></li>
              <li><a href="#">Profile</a></li>
            </ul>
          </nav>
    </header>
    <main>
        <section class="category">
            <div class="title-friends-row row">
                <h2 class="col-9">Reading</h2>
                <button class="card find-friends">👥 Find friends!</button>
            </div>
            <div class="current-read">
                I am currently reading... The Cat in the Hat
            </div>

            <div class="recent-list">
                <div class="list-titles row">
                    <h3 class="col-3">My most recent entries:</h3>
                    <h4 class="dates col-3">Date finished:</h4>
                </div>
                <div class="books-and-dates row">
                    <ul class="col-3">
                        <li>The Cat in the Hat</li>
                        <li>Little Women</li>
                        <li>The Hunger Games</li>
                    </ul>
                    <ul class="dates col-3">
                        <li>Currently reading</li>
                        <li>01/03/2025</li>
                        <li>09/25/2024</li>
                    </ul>
                </div>
            </div>

            <form class="new-entry-form" action="example_hobby.html">
                <label class="add-entry" for="add-entry">Add a new entry:</label>
                <input type="text" class="add-entry" id="add-entry">
                <button type="submit" name="submit-category" class="submit-category">Add</button>
            </form>
        </section>
    </main>
    
    <footer>
        <p>
          &copy; 2024 Website. All rights reserved. This is a Class Project! 
        </p>
    </footer>

</body>
</html>