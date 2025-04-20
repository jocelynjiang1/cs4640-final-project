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

  <script>
    function validateLogin(){ //validate input formats
      var user = document.getElementById("username").value;
      var email = document.getElementById("email").value;
      var pwd = document.getElementById("password").value;
      var msg = document.getElementById("message");
      if(user=="" || pwd=="" || email==""){
        msg.innerHTML = "Please fill out all fields to log in!";
        return false;
      }
      const email_format = /[A-Za-z]+@[A-Za-z]+.[A-Za-z]+/;
      const pwd_format = /^[^\s]+$/;
      console.log(email_format);
      console.log(pwd_format);
      console.log(pwd);
      console.log(!email_format.test(email));
      console.log(!pwd_format.test(pwd));
      if(!email_format.test(email)){
        msg.innerHTML = "Please enter a valid email!";
        return false;
      }
      if(!pwd_format.test(pwd)){
        msg.innerHTML = "Please enter a valid password!";
        return false;
      }
    }
  </script>
</head>
<body>
  <div class="container">
    <h1>Hobby Tracker</h1>
    
    <form onsubmit="return validateLogin();" action="?command=login" class="login-form" method="post">
      <input 
        type="text" 
        class="email-input" 
        name="username"
        id = "username"
        placeholder="Username" 
        required
      >
      <input 
        type="email" 
        class="email-input" 
        name="email"
        id="email"
        placeholder="mail@example.com" 
        required
      >
      <div class="password-section">
        <input 
          type="password" 
          class="password-input" 
          name="password"
          id="password"
          placeholder="Password" 
          required
        >
      </div>
      <p id="message"><?= $message ?></p>
      
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