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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js" integrity="sha512-+k1pnlgt4F1H8L7t3z95o3/KO+o78INEcXTbnoJQ/F2VqDVhWoaiVml/OEHv9HsVgxUaVW+IbiZPUJQfF/YxZw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script>
    $(document).ready(function(){
      $(".add-hobby-card").on("mouseenter",getQuickStats);
      $(".add-hobby-card").on("mouseleave",restoreBaseDetails);
    });

    var base_details;

    async function getQuickStats(){
      var hobby_div = this;
      let hobby_id = this.id;
      var ajax = new XMLHttpRequest();
      console.log(hobby_div);
      ajax.open("GET","http://localhost:8080/cs4640-final-project/?command=hobby_page&hobby_id="+hobby_id+"&format=json",true);
      ajax.responseType = "json";
      ajax.send(null);

      ajax.addEventListener("load", function(){
        if(this.status==200){
          console.log("it worked");
          
          //"Define, instantiate, and use at least one JavaScript object"...create object to store attributes of this.response?
          var num_entries = this.response["entries"].length; //use returned json data
          let p_details = hobby_div.querySelector('p[name="details"]'); //Googled how to select child element in js
          base_details = p_details.innerHTML; //set variable for mouseleave handler
          p_details.innerHTML+="<br> This hobby has "+num_entries+" entries!";

          if(num_entries>0){
            var raw_last_date = this.response["entries"][0]["created_at"].split(".")[0];
            var last_date = new Date(raw_last_date);
            var as_day = last_date.toDateString();
            p_details.innerHTML+="<br>"+"Last entry: "+as_day;
          }
        }
        else{
          console.log("failed");
        }
      });
    }

    function restoreBaseDetails(){
      console.log("base details: "+base_details);
        var hobby_div = this;
        let p_details = hobby_div.querySelector('p[name="details"]'); //Googled how to select child element in js
          p_details.innerHTML= base_details;
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
                <div class='card add-hobby-card' id='$hobby_id'>
                <h3>$hobby_name</h3>
                <p name='details'>
                    $hobby_description
                </p>
                </div>
              </button>
            </form>";
          }
        ?>
        <form action="?command=showAddHobby" method="post">
          <button type="submit">
          <div class="card add-hobby-card" id="add-hobby-card">
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