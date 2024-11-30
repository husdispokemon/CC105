<?php require 'db_con.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            color: #333;
        }

        .container {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            background-color: white;
            border: 2px solid #c29201;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .logo img {
            max-width: 150px;
            margin-bottom: 10px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        .form-title {
            font-size: 24px;
            font-weight: bold;
            color: #c29201;
            margin-bottom: 20px;
            text-align: left; /* Aligns the title to the left */
        }

        .form-row {
            display: flex;
            justify-content: space-between;
            gap: 20px; /* Ensures enough spacing between columns */
            margin-bottom: 15px;
        }

        .form-group {
            flex: 1; /* Makes input fields evenly spaced */
            text-align: left;
        }

        .form-group label {
            font-weight: bold;
            font-size: 14px;
            display: block;
        }

        .form-group label span {
            color: red;
        }

        .form-group input {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            box-sizing: border-box; 
        }

        .form-group-checkbox {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .form-group-checkbox input[type="checkbox"] {
            margin-right: 5px; /* Adds space between checkbox and text */
        }

        .submit-btn {
            width: 100%;
            padding: 10px;
            background-color: #c29201;
            color: white;
            font-size: 16px;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }

        .submit-btn:hover {
            background-color: #c29201;
        }

        .footer {
            font-size: 12px;
            margin-top: 15px;
            text-align: center;
        }

        .footer a {
            color: #c29201;
            text-decoration: none;
            font-weight: bold;
        }

        .footer a:hover {
            text-decoration: underline;
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
    margin-left: 5px; 
    margin-right: 5px; 
    font-family: 'Times New Roman';
    font-weight: lighter;
}

.auth-buttons a:hover, .nav-menu a:hover {
    text-decoration: underline;
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
}
    </style>
</head>
<body>
    <header>
        <div class="navbar">
            <nav class="nav-menu">
                <ul>
                    <li><a href="home.php">Home</a></li>
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
    <div class="container">
        <div class="logo">
            <img src="casa.jpg" alt="CASA ESTELA Logo">
        </div>
        <div class="form-title">Sign Up!</div>
        <form action="sign_up form.php" method="post">
            <div class="form-row">
                <div class="form-group">
                    <label for="firstName">First Name <span>*</span></label>
                    <input type="text" id="firstName" name="firstName" required>
                </div>
                <div class="form-group">
                    <label for="lastName">Last Name <span>*</span></label>
                    <input type="text" id="lastName" name="lastName" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="email">Email <span>*</span></label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone Number <span>*</span></label>
                    <input type="tel" id="phone" name="phone" placeholder="+63" required>
                </div>
            </div>
            <div class="form-group">
                <label for="address">Address <span>*</span></label>
                <input type="text" id="address" name="address" required>
            </div>
            <div class="form-group">
                <label for="password">Password <span>*</span></label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="confirmPassword">Confirm Password <span>*</span></label>
                <input type="password" id="confirmPassword" name="confirmPassword" required>
            </div>
            <div class="form-group-checkbox">
                <input type="checkbox" id="showPassword">
                <label for="showPassword">Show Password</label>
            </div>
            <button type="submit" name="insertUser" class="submit-btn">SIGN UP</button>
        </form>
        
        <div class="footer">
            By signing in or creating an account, you agree with our 
            <a href="#">Terms & conditions</a> and <a href="#">Privacy statement</a>.
            <br><br>
            Already have an account? <a href="login.php">Log In</a>
        </div>
    </div>

    <script>
       
        document.getElementById('showPassword').addEventListener('change', function() {
            const passwordField = document.getElementById('password');
            const confirmPasswordField = document.getElementById('confirmPassword');
            const type = this.checked ? 'text' : 'password';
            passwordField.type = type;
            confirmPasswordField.type = type;
        });

        
        document.getElementById('signupForm').addEventListener('submit', function(event) {
            event.preventDefault(); 

            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirmPassword').value;

            if (password !== confirmPassword) {
                alert('Passwords do not match!');
                return;
            }

            alert('Sign-up successful! Redirecting...');
            window.location.href = 'login.php';
        });
    </script>
</body>
</html>
