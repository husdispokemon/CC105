<?php
session_start();
require 'db_con.php';

// Check if the user is logged in
$user_logged_in = isset($_SESSION['user_id']);

if (isset($_POST['submit_booking'])) {
    // Store booking details in variables (instead of directly in session for clarity)
    $firstName = htmlspecialchars($_POST['first_name']);
    $lastName = htmlspecialchars($_POST['last_name']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $phone = htmlspecialchars($_POST['phone']);
    $address = htmlspecialchars($_POST['address']);
    $city = htmlspecialchars($_POST['city']);
    $country = htmlspecialchars($_POST['country']);
    $roomType = htmlspecialchars($_POST['room_type']);
    $total_price = htmlspecialchars($_POST['total_price']);
    $checkIn = htmlspecialchars($_POST['check_in']);
    $checkOut = htmlspecialchars($_POST['check_out']);

    // Insert booking details into the database
    $stmt = $pdo->prepare("INSERT INTO bookings (first_name, last_name, email, phone, address, city, country, room_type, total_price, check_in, check_out) 
    VALUES (:first_name, :last_name, :email, :phone, :address, :city, :country, :room_type, :total_price, :check_in, :check_out)");

    $stmt->bindParam(':first_name', $firstName);
    $stmt->bindParam(':last_name', $lastName);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':city', $city);
    $stmt->bindParam(':country', $country);
    $stmt->bindParam(':room_type', $roomType);
    $stmt->bindParam(':total_price', $total_price);
    $stmt->bindParam(':check_in', $checkIn);
    $stmt->bindParam(':check_out', $checkOut);

    if ($stmt->execute()) {
        $_SESSION['booking_id'] = $pdo->lastInsertId(); // Save booking_id for payment reference
        header('Location: rmpayment.php');
        exit();
    } else {
        echo "Error: Could not save the booking details.";
    }
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Booking</title>
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
            background-color: #ccc;
            /* Fallback color */
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
            top: 60px;
            /* Adjust based on your layout */
            right: 10px;
            /* Adds space from the right edge */
            background-color: #f8f8f8;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            z-index: 10;
            width: 200px;
            padding: 10px 0;
            margin-right: 10px;
            /* Optional: Adds more space from the right */
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
            transition: background-color 0.3s ease;
            /* Smooth transition */
        }

        .dropdown-menu li:hover {
            background-color: #c29201;
            /* Hover background color */
            cursor: pointer;
            /* Change cursor to pointer */
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
            font-size: 16px;
            /* Adjust icon size */
            font-family: 'Times New Roman';
            /* Font family for icons */
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: auto;
        }

        form h2,
        h3 {
            color: #c29201;
            text-align: center;
        }

        form label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        form input,
        select,
        button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            background-color: #c29201;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #a37401;
        }
    </style>
</head>

<body>
    <header>
        <div class="navbar">
            <nav class="nav-menu">
                <ul>
                    <li><a href="home.php">Home</a></li>
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
                    <a href="sign_up.php" class="signup">Sign Up</a>
                <?php endif; ?>
            </div>
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
                    event.preventDefault(); // Prevent the default link behavior

                    // Display confirmation dialog
                    var confirmation = confirm("Are you sure you want to log out?");

                    if (confirmation) {
                        // If confirmed, log out the user
                        window.location.href = "logout.php"; // Redirect to logout script
                    }
                }

            };

            function updatePrice() {
    const roomType = document.getElementById("room_type").value;
    const priceDisplay = document.getElementById("price");
    const hiddenPrice = document.getElementById("hidden_price");

    let total_price = 0;
    if (roomType === "Standard Double Room") {
        total_price = 3600;
    } else if (roomType === "Family Room") {
        total_price = 4600;
    } else if (roomType === "Deluxe Family Room") {
        total_price = 5500;
    }

    // Update the displayed price and hidden input value
    priceDisplay.textContent = "Price: PHP " + total_price.toLocaleString();
    hiddenPrice.value = total_price;
}

        </script>
    </header><br>

    <form action="" method="POST">
        <h2>Enter your details</h2>
        <label for="first_name">First Name*</label>
        <input type="text" name="first_name" id="first_name" required>

        <label for="last_name">Last Name*</label>
        <input type="text" name="last_name" id="last_name" required>

        <label for="email">Email Address*</label>
        <input type="email" name="email" id="email" required>

        <label for="phone">Phone Number (optional)</label>
        <input type="text" name="phone" id="phone">

        <label for="address">Address*</label>
        <input type="text" name="address" id="address" required>

        <label for="city">City*</label>
        <input type="text" name="city" id="city" required>

        <label for="country">Country*</label>
        <input type="text" name="country" id="country" required>

        <h3>Your Booking Details</h3>
        <label for="room_type">Room Type*</label>
        <select name="room_type" id="room_type" required onchange="updatePrice()">
            <option value="Standard Double Room">Standard Double Room - PHP 3,600</option>
            <option value="Family Room">Family Room - PHP 4,600</option>
            <option value="Deluxe Family Room">Deluxe Family Room - PHP 5,500</option>
        </select>


        <label for="check_in">Check-In Date*</label>
        <input type="date" name="check_in" id="check_in" required>

        <label for="check_out">Check-Out Date*</label>
        <input type="date" name="check_out" id="check_out" required>

        <p id="price">Price: PHP 3,600</p>
        <input type="hidden" name="total_price" id="hidden_price" value="3600">

        <button type="submit" name="submit_booking">Proceed to Payment</button>
    </form>





</body>

</html>