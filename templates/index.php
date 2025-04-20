<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Deployed at https://cs4640.cs.virginia.edu/ana2ag/sprint3/ -->
  <meta charset="UTF-8">
  <meta name="author" content="Jennifer Liu">
  <title>Hobby Tracker</title>

  <!-- Google Font (Architects Daughter) -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link 
    href="https://fonts.googleapis.com/css2?family=Architects+Daughter&display=swap" 
    rel="stylesheet">
  <link rel="stylesheet" href="style/styles.css">
</head>
<body>
  <div class="container">
    <h1>Hobby Tracker</h1>
    
    <form action="?command=login" class="login-form" method="post">
      <input 
        type="text" 
        class="email-input" 
        name="username"
        placeholder="Username" 
        required
      >
      <input 
        type="email" 
        class="email-input" 
        name="email"
        placeholder="mail@example.com" 
        required
      >
      <div class="password-section">
        <input 
          type="password" 
          class="password-input" 
          name="password"
          placeholder="Password" 
          required
        >
      </div>
      <?= $message ?>
      <button type="submit">Sign In</button>
      <a href="#" class="signup-link">Sign Up Here</a>
    </form>
  </div>

  <!-- Floating icons around the page -->
  <div class="floating-icons">
    <span class="icon icon-gift">🎁</span>
    <span class="icon icon-camera">📷</span>
    <span class="icon icon-globe">🌐</span>
    <span class="icon icon-paint">🖌️</span>
    <span class="icon icon-alarm">⏰</span>
    <span class="icon icon-smile">😀</span>
    <span class="icon icon-bookmark">🔖</span>
    <span class="icon icon-tool">🔨</span>
    <span class="icon icon-music">🎶</span>
    <span class="icon icon-soccer">⚽</span>
    <span class="icon icon-cook">🍳</span>
    <span class="icon icon-book">📚</span>
    <span class="icon icon-plane">✈️</span>
    <span class="icon icon-game">🎮</span>
    <span class="icon icon-palette">🎨</span>
    <span class="icon icon-run">🏃</span>
  </div>
</body>
</html>