<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="author" content="Jocelyn Jiang and Jennifer Liu">
  <title>Hobby Page</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Architects+Daughter&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style/home.css">
  <link rel="stylesheet" href="style/add_view_hobby.css">
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
      <div class="title-friends-row row">
        <h2 class="col-9"><?= htmlspecialchars($hobby_name) ?></h2>
        <button class="card find-friends">👥 Find friends!</button>
      </div>
      <div class="hobby-description">
        <p><?= htmlspecialchars($hobby_description) ?></p>
      </div>

      <section class="entries">
        <h3>Entries</h3>
        <?php if (!empty($entries)) { ?>
          <ul>
            <?php foreach ($entries as $entry) { ?>
              <li><?= htmlspecialchars($entry["entry_text"]) ?> <small>(<?= htmlspecialchars($entry["created_at"]) ?>)</small></li>
            <?php } ?>
          </ul>
        <?php } else { ?>
          <p>No entries yet.</p>
        <?php } ?>
      </section>

      <form class="new-entry-form" action="?command=createHobbyEntry" method="post">
        <input type="hidden" name="hobby_id" value="<?= htmlspecialchars($hobby_id) ?>">
        <label class="add-entry" for="add-entry">Add a new entry:</label>
        <input type="text" class="add-entry" name="entry_text" id="add-entry">
        <button type="submit" name="submit-category" class="submit-category">Add</button>
      </form>

      <div class="hobby-actions">
  <a href="?command=editHobby&hobby_id=<?= htmlspecialchars($hobby_id) ?>" class="edit-button">Edit Hobby</a>
</div>


      <?php if (isset($_GET["error"])) { ?>
        <p class="error"><?= htmlspecialchars($_GET["error"]) ?></p>
      <?php } ?>
    </section>
  </main>
  
  <footer>
    <p>&copy; 2024 Website. All rights reserved. This is a Class Project!</p>
  </footer>
</body>
</html>
