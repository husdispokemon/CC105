<?php require 'db_con.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <style>
           body {
        font-family: Arial, sans-serif;
        margin: 0;
        background-color: #f9f9f9;
    }

    header {
        background-color: white;
        padding: 10px 0;
        box-shadow: 0 4px 2px -2px gray;
    }

    .navbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: #c29201;
        height: 50px;
        padding: 0 20px;
    }

    .logo {
    text-align: left;
    padding: 20px 0 0 20px;
}

.logo h1 {
    color: #c29201;
    font-family: 'Brush Script MT', cursive;
    font-size: 2.5em;
}

.logo p {
    color: #c29201;
    font-size: 1.2em;
    margin-top: -10px;
    text-align: left;
}

    .login-container {
        margin: 20px auto; /* Center the login container and space it below the logo */
        width: 400px;
        border: 1px solid #cf9b10;
        border-radius: 10px;
        padding: 20px 30px;
        background-color: white;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .login-container .logo img {
        max-width: 100px;
        margin-bottom: 10px;
        display: block;
        margin-left: auto;
        margin-right: auto;
    }



        h2 {
            color: #cf9b10;
            text-align: center;
            margin-bottom: 10px;
            font-size: 20px;
        }

        p {
            text-align: center;
            font-size: 14px;
            margin-bottom: 20px;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-size: 14px;
            color: #333;
        }

        input[type="email"],
        input[type="password"] {
            width: 95%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        .options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .options label {
            display: flex;
            align-items: center;
            font-size: 14px;
        }

        .options input[type="checkbox"] {
            margin-right: 5px;
        }

        .options a {
            font-size: 14px;
            color: #cf9b10;
            text-decoration: none;
        }

        .options a:hover {
            text-decoration: underline;
        }

        button {
            width: 100%;
            padding: 10px;
            border: none;
            background-color: #cf9b10;
            color: white;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #b88a0b;
        }

        .signup {
            text-align: center;
            margin-top: 10px;
            font-size: 14px;
        }

        .signup a {
            color: #cf9b10;
            text-decoration: none;
        }

        .signup a:hover {
            text-decoration: underline;
        }
        .logo img {
            max-width: 100px;
            margin-bottom: 10px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
        * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Arial', sans-serif;
}

header {
    background-color: white;
    padding: 10px 0;
    box-shadow: 0 4px 2px -2px gray;
}

.navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #c29201;
    height: 50px;
    padding: 0 20px;
    position: relative;
}

.nav-menu {
    position: absolute;
    left: 50%;
    transform: translateX(-50%);
}

.nav-menu ul {
    list-style-type: none;
    display: flex;
    gap: 20px;
}

.nav-menu a {
    color: white;
    text-decoration: none;
    font-family: 'Times New Roman';
    font-weight: lighter;
}

.auth-buttons .separator {
    color: white; 
    margin: 0 5px; 
    font-weight: normal; 
}


.auth-buttons {
    margin-left: auto;
}

.auth-buttons a {
    color: white;
    text-decoration: none;
    margin-left: 5px; /* Decrease left margin for the second link */
    margin-right: 5px; /* Optional: adjust right margin for the first link */
    font-family: 'Times New Roman';
    font-weight: lighter;
}

.auth-buttons a:hover, .nav-menu a:hover {
    text-decoration: underline;
}

        
    </style>
</head>

<body>
    <header>
        <div class="navbar">
            <nav class="nav-menu">
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Rooms</a></li>
                    <li><a href="#">Café</a></li>
                    <li><a href="#">Garden</a></li>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Contact Us</a></li>
                </ul>
            </nav>
            <div class="auth-buttons">
                <a href="login.php" class="login">Log In</a> 
                <span class="separator">|</span>
                <a href="sign up.php" class="signup">Sign Up</a>
            </div>
            
        </div>
        <div class="logo">
            <h1>Casa Estela</h1>
            <p>- A Place to Call Home</p>
        </div>
    </header>
    
    <div class="login-container">
        <div class="logo">
            <img src="casa.jpg" alt="CASA ESTELA Logo">
        </div>
        <h2>Log In Now!</h2>
        <p>Log in your account using email address</p>

        <form action="login_con.php" method="POST">
            <label for="email">Email Address<span style="color: red;">*</span></label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password<span style="color: red;">*</span></label>
            <input type="password" id="password" name="password" required>

            <div class="options">
                <label>
                    <input type="checkbox" id="showPassword"> Show Password
                </label>
                <a href="#">Forgot password?</a>
            </div>

            <button type="submit">Log In</button>
        </form>

        <div class="signup">
            Don’t have an account? <a href="sign up.php">Sign In</a>
        </div>
    </div>

    <script>
        document.getElementById('showPassword').addEventListener('change', function() {
            const passwordField = document.getElementById('password');
            passwordField.type = this.checked ? 'text' : 'password';
        });

        document.getElementById('loginForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            if (email === 'user@example.com' && password === 'password123') {
                alert('Login successful!');
                window.location.href = "home.html";
            } else {
                alert('Invalid credentials. Please try again.');
            }
        });
    </script>
</body>
</html>
