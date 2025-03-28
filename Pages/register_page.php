<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Register</title>
</head>
<body>
    <div class="form">
        <form method="post" id="registerForm">
            <h1>Register</h1>
            <p>Status: <span id="status"></span></p> <br>
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input class="form-control" type="text" id="user" name="user">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3 mt-4">
                <label class="form-label">Passsword</label>
                <input class="form-control" type="password" id="pass" name="pass">
            </div>
            <div class="mb-3 mt-4">
                <label class="form-label">Confirm Password</label>
                <input class="form-control" type="password" id="confpass" name="confpass">
            </div>
            <div class="d-grid">
                <button class="btn btn-primary my-4" onclick="fetchData()">Register</button>
            </div>
            <p>Already have an account? <a href="/login">Login here</a></p> <br><br>
            <p id="msg"></p>
        </form> 
        <br><br>
    </div>
    <script>
        function fetchData() {
            event.preventDefault();

            let formData = new FormData(document.getElementById("registerForm"));
            let message = document.getElementById("msg");

            fetch("/api/register.php", {
                method: "POST",
                body: formData
            })

            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.href = data.redirect;
                } else {
                    message.textContent = data.message || "Registration failed!";
                }
             })
            .catch(err => console.log("Error: ", err));
        }

        function fetchStatus() {
            fetch("/api/status.php")
                .then(response => response.text())
                .then(data => {
                    document.getElementById("status").textContent = data;
                })
                .catch(err => console.log("Error: " + err));
        }

        window.onload = function() {
             fetchStatus();
        };
    </script>
</body>

<style>
    /* lazy frontend */
    * {
        margin: 0;
        padding: 0;
    }

    .form {
        height: 100vh;
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>
</html>