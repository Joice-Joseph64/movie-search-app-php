<?php
require_once "../config/database.php";


if(!empty($_SESSION['user_id']))
{
    $check = 1;
    //echo "yes";
}
else{
    $check = 0;
    //echo "no user id";
}

?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type = "text/css" href = "../css/style.css">
    </head>
    <body>
        <div class = "container">
            <div class = "header">
                <div class = "logo">Movie Search
                    <div class = "loginbtn">
                        <ul class = "ul1">
                        <?php if($check == 1):?>
                            <li class = "li1"><a href = "../auth/logout.php" class = "homelink">Logout</a></li>
                        <?php else: ?>
                            <li class = "li1"><a href = "../auth/login.php" class = "homelink">Login</a></li>
                            <li class = "li1"><a href = "../auth/register.php" class = "homelink">Sign In</a></li>
                        <?php endif?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="home-img-container">
                <h1 class="login-title">Welcome to the World Of Cinema</h1>
                <img src="https://koditips.com/wp-content/uploads/hd-movies-tool.jpg" alt="Homepage Image" class="home-img" />

            </div>
            <?php if($check == 1):?>
                <h1 class="login-title">Movie Search App</h1>
            <div class="search-container">
                
                <input type="text" id="search" placeholder="Enter movie title" class="movie-search-input">
                <button id="searchBtn" class="movie-search-btn">Search</button>

                <!-- <div id="results"></div> -->
            </div>

            <div id="results" class="result-container"></div>
            <?php endif?>
        </div>

        <script>

    function searchMovies() {
      var title = document.getElementById("search").value.trim();
      if (title === "") {
        alert("Please enter a movie title.");
        return;
      }
      
      var apiKey = "c81718a5";
    //   var url = "https://www.omdbapi.com/?apikey=" + apiKey + "&s=" + encodeURIComponent(title);

      var url = "https://www.omdbapi.com/?i=tt3896198&apikey=" + apiKey + "&s=" + encodeURIComponent(title);
      
      fetch(url)
        .then(function(response) {
          return response.json();
        })
        .then(function(data) {
          var resultsDiv = document.getElementById("results");
          resultsDiv.innerHTML = "";
          if (data.Response === "True") {
            data.Search.forEach(function(movie) {
              var movieDiv = document.createElement("div");
              movieDiv.className = "movie";
              var movieInfo = document.createElement("div");
              movieInfo.className = "movie-info";
              
              var img = document.createElement("img");
              img.src = (movie.Poster !== "N/A") ? movie.Poster : "placeholder.png";
              img.alt = movie.Title;
              movieInfo.appendChild(img);
              
              var infoText = document.createElement("div");
              infoText.innerHTML = "<h3>" + movie.Title + "</h3><p>Year: " + movie.Year + "</p>";
              movieInfo.appendChild(infoText);
              
              movieDiv.appendChild(movieInfo);
              resultsDiv.appendChild(movieDiv);
            });
          } else {
            resultsDiv.innerHTML = "<p>No movies found. Try another title.</p>";
          }
        })
        .catch(function(error) {
          console.error("Error fetching data:", error);
          alert("Error fetching movie data. Please try again later.");
        });
    }

    document.getElementById("searchBtn").addEventListener("click", searchMovies);

    document.getElementById("search").addEventListener("keyup", function(event) {
      if (event.key === "Enter") {
        searchMovies();
      }
    });
  </script>


    </body>
</html>