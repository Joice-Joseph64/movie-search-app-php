function searchMovies() {
    var title = document.getElementById("search").value.trim();
    if (title === "") {
        alert("Please enter a movie title.");
        return;
    }

    var apiKey = "c81718a5";
    var url = "https://www.omdbapi.com/?s=" + encodeURIComponent(title) + "&apikey=" + apiKey;

    fetch(url)
        .then(function (response) {
            return response.json();
        })
        .then(function (data) {
            var resultsDiv = document.getElementById("results");
            resultsDiv.innerHTML = "";
            if (data.Response === "True") {
                data.Search.forEach(function (movie) {
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

                    var favBtn = document.createElement("button");
                    favBtn.className = "favorite-btn";
                    favBtn.textContent = "Add to Favorites";
                    favBtn.setAttribute("data-movie-id", movie.imdbID);
                    favBtn.setAttribute("data-title", movie.Title);
                    favBtn.setAttribute("data-poster", movie.Poster);

                    movieDiv.appendChild(movieInfo);
                    movieDiv.appendChild(favBtn);
                    resultsDiv.appendChild(movieDiv);
                });
            } else {
                resultsDiv.innerHTML = "<p>No movies found. Try another title.</p>";
            }
        })
        .catch(function (error) {
            console.error("Error fetching data:", error);
            alert("Error fetching movie data. Please try again later.");
        });
}

function addToFavorites(movieId, title, poster) {
    var formData = new FormData();
    formData.append("movie_id", movieId);
    formData.append("movie_title", title);
    formData.append("poster_url", poster);

    fetch('../wishlist/add_to_favorites.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.text())
        .then(data => {
            alert(data); 
        })
        .catch(error => console.error('Error:', error));
}

document.addEventListener('click', function (event) {
    if (event.target && event.target.classList.contains('favorite-btn')) {
        var movieId = event.target.getAttribute('data-movie-id');
        var title = event.target.getAttribute('data-title');
        var poster = event.target.getAttribute('data-poster');
        addToFavorites(movieId, title, poster);
    }
});

document.getElementById("searchBtn").addEventListener("click", searchMovies);

document.getElementById("search").addEventListener("keyup", function (event) {
    if (event.key === "Enter") {
        searchMovies();
    }
});

//TO REMOVE FROM FAVORITE MOVIES

function loadFavorites() {
    fetch('../wishlist/favorites.php')
        .then(response => response.json())
        .then(favorites => {
            debugger;
            // var favoritesDiv = document.getElementById("favorites");
            // var favoritesDiv = document.createElement("div");
            // favoritesDiv.className = "favorites";
            // if(favoritesDiv) {
            //     favoritesDiv.innerHTML = "";

            // }
            var favoritesDiv = document.getElementById("favorites");

            if (!favoritesDiv) {
                favoritesDiv = document.createElement("div");
                favoritesDiv.id = "favorites";
                favoritesDiv.className = "favorites";
                document.body.appendChild(favoritesDiv);
            }
            favoritesDiv.innerHTML = "";

            if (favorites.length > 0) {
                favorites.forEach(function (movie) {
                    var movieDiv = document.createElement("div");
                    movieDiv.className = "movie";

                    var movieInfo = document.createElement("div");
                    movieInfo.className = "movie-info";

                    var img = document.createElement("img");
                    img.src = movie.poster_url || "placeholder.png";
                    img.alt = movie.movie_title;
                    movieInfo.appendChild(img);

                    var infoText = document.createElement("div");
                    infoText.innerHTML = "<h3>" + movie.movie_title + "</h3>";
                    movieInfo.appendChild(infoText);

                    var removeBtn = document.createElement("button");
                    removeBtn.className = "remove-favorite-btn";
                    removeBtn.textContent = "Remove";
                    removeBtn.setAttribute("data-movie-id", movie.movie_id);
                    removeBtn.addEventListener("click", function () {
                        removeFromFavorites(movie.movie_id);
                    });

                    movieDiv.appendChild(movieInfo);
                    movieDiv.appendChild(removeBtn);
                    favoritesDiv.appendChild(movieDiv);
                });
            } else {
                favoritesDiv.innerHTML = "<p>You haven't added any favorite movies yet.</p>";
            }
        })
        .catch(error => console.error('Error loading favorites:', error));
}

function removeFromFavorites(movieId) {
    debugger
    var formData = new FormData();
    formData.append("movie_id", movieId);

    fetch('../wishlist/remove_from_favorites.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.text())
        .then(data => {
            alert(data);
            loadFavorites();
        })
        .catch(error => console.error('Error:', error));
}

window.onload = function () {
    loadFavorites();
};

