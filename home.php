<?php
session_start();
require 'db_con.php';

// Check if the user is logged in
$user_logged_in = isset($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="style1.css">
    <style>
        
/* Profile Circle */
.profile-circle {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    overflow: hidden;
    display: inline-block;
    margin-right: 10px;
    background-color: #ccc; /* Fallback color */
    position: relative;
}

.profile-circle img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* User Dropdown */
.user-dropdown {
    position: relative;
    display: inline-block;
    cursor: pointer;
}

.user-info {
    display: flex;
    align-items: center;
}

.user-info {
    color: white;
    text-decoration: none;
    font-family: 'Times New Roman';
    font-weight: lighter;
}
/* Dropdown Menu */
.dropdown-menu {
    display: none;
    position: absolute;
    top: 60px; /* Adjust based on your layout */
    right: 10px; /* Adds space from the right edge */
    background-color: #f8f8f8;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    border-radius: 5px;
    z-index: 10;
    width: 200px;
    padding: 10px 0;
    margin-right: 10px; /* Optional: Adds more space from the right */
}

/* Remove the default list-style and padding */
.dropdown-menu ul {
    list-style: none;
    margin: 0;
    padding: 0;
}

/* Hover effect for list items */
.dropdown-menu li {
    padding: 10px 20px;
    white-space: nowrap;
    transition: background-color 0.3s ease; /* Smooth transition */
}

.dropdown-menu li:hover {
    background-color: #c29201; /* Hover background color */
    cursor: pointer; /* Change cursor to pointer */
}

/* Remove underlines from links */
.dropdown-menu a {
    text-decoration: none;
    color: #333;
    display: flex;
    align-items: center;
}

/* Styling for icons inside the dropdown */
.dropdown-menu a i {
    margin-right: 10px;
    font-size: 16px; /* Adjust icon size */
    font-family: 'Times New Roman'; /* Font family for icons */
}


</style>
</head>
<body>
    <header>
        <div class="navbar">
            <nav class="nav-menu">
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="Room.php">Rooms</a></li>
                    <li><a href="#">Café</a></li>
                    <li><a href="#">Garden</a></li>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Contact Us</a></li>
                </ul>
            </nav>
            <div class="auth-buttons">
                <?php if ($user_logged_in): ?>
                    <div class="user-info user-dropdown" onclick="toggleDropdown()">
                    <div class="profile-circle">
                    <!-- You can add an image here or a default icon for the profile -->
                    <img src="fam.jpg" alt="Profile Picture">
                </div>
                        <span><?= htmlspecialchars($_SESSION['first_name'] . ' ' . $_SESSION['last_name']) ?></span>
                    </div>
                     <!-- Dropdown Menu -->
            <div class="dropdown-menu" id="dropdownMenu">
                <ul>
                    <li><a href="manage_acc.php"><i class="icon-user"></i> Manage Account</a></li>
                    <li><a href="bookings.php"><i class="icon-calendar"></i> Bookings&Reservations</a></li>
                    <li><a href="orders.php"><i class="icon-cart"></i> Orders</a></li>
                    <li><a href="feedbacks.php"><i class="icon-thumbs-up"></i> Feedbacks</a></li>
                    <li><a href="logout.php" onclick="confirmLogout(event)"><i class="icon-power-off"></i> Log out</a></li>

                </ul>
            </div>
                <?php else: ?>
                    <a href="login.php" class="login">Log In</a>
                    <span class="separator">|</span>
                    <a href="sign up.php" class="signup">Sign Up</a>
                <?php endif; ?>
            </div>
        </div>
        <div class="logo">
            <h1>Casa Estela</h1>
            <p>- A Place to Call Home</p>
        </div>
        <script>
// Toggle the dropdown menu
function toggleDropdown() {
    var dropdownMenu = document.getElementById("dropdownMenu");
    // Toggle visibility
    dropdownMenu.style.display = dropdownMenu.style.display === "block" ? "none" : "block";
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
    var dropdownMenu = document.getElementById("dropdownMenu");
    var userDropdown = document.querySelector(".user-dropdown");

    // Close the dropdown if the click is outside the user dropdown
    if (!userDropdown.contains(event.target)) {
        dropdownMenu.style.display = "none";
    }
   // Function to confirm logout
   function confirmLogout(event) {
                event.preventDefault();  // Prevent the default link behavior

                // Display confirmation dialog
                var confirmation = confirm("Are you sure you want to log out?");

                if (confirmation) {
                    // If confirmed, log out the user
                    window.location.href = "logout.php"; // Redirect to logout script
                }
            }

};
</script>

    </header>
</body>
</html>
