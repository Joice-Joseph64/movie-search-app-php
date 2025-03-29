<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Movie Search App</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 20px;
    }
    #results {
      margin-top: 20px;
    }
    .movie {
      margin-bottom: 20px;
      padding-bottom: 10px;
      border-bottom: 1px solid #ddd;
    }
    .movie img {
      max-width: 100px;
      margin-right: 10px;
    }
    .movie-info {
      display: flex;
      align-items: center;
    }
  </style>
</head>
<body>
  <h1>Movie Search App</h1>
  <input type="text" id="search" placeholder="Enter movie title">
  <button id="searchBtn">Search</button>

  <div id="results"></div>

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
