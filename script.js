function register() {
    fetch("auth/register.php", {
        method: "POST",
        body: JSON.stringify({
            name: document.getElementById("reg-name").value,
            email: document.getElementById("reg-email").value,
            password: document.getElementById("reg-pass").value
        }),
        headers: { "Content-Type": "application/json" }
    })
    .then(res => res.json())
    .then(data => alert(data.message || data.error));
}

function login() {
    fetch("auth/login.php", {
        method: "POST",
        body: JSON.stringify({
            email: document.getElementById("login-email").value,
            password: document.getElementById("login-pass").value
        }),
        headers: { "Content-Type": "application/json" }
    })
    .then(res => res.json())
    .then(data => {
        if (data.token) {
            localStorage.setItem("authToken", data.token);
            alert("Login successful!");
        } else {
            alert(data.error);
        }
    });
}

function searchMovie() {
    let query = document.getElementById("search-query").value;
    fetch(`movies/search.php?query=${query}`)
    .then(res => res.json())
    .then(data => {
        let output = "";
        data.Search.forEach(movie => {
            output += `<p>${movie.Title} (${movie.Year})</p>`;
        });
        document.getElementById("results").innerHTML = output;
    });
}
