<?php
session_start();
require 'db_con.php';
// Check if the user is logged in
$user_logged_in = isset($_SESSION['user_id']);
// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Ensure a booking exists
if (!isset($_SESSION['booking_id'])) {
    echo "<script>
            alert('No booking found. Please make a booking first.');
            window.location.href = 'Room.php';
          </script>";
    exit();
}

$bookingId = $_SESSION['booking_id'];

try {
    // Fetch booking details
    $stmt = $pdo->prepare("SELECT * FROM bookings WHERE booking_id = :booking_id");
    $stmt->bindParam(':booking_id', $bookingId, PDO::PARAM_INT);
    $stmt->execute();
    $booking = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$booking) {
        throw new Exception("Booking not found for ID: $bookingId");
    }

    // Payment data
    $roomType = htmlspecialchars($booking['room_type']);
    $price = $booking['total_price'];
    $formattedPrice = number_format($price, 2);
    $formattedDownpayment = number_format($price * 0.3, 2);

    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm_payment'])) {
        $paymentType = htmlspecialchars($_POST['payment_type']);
        $paymentMethod = htmlspecialchars($_POST['payment_method']);

        // Validate inputs
        $validPaymentTypes = ['downpayment', 'fully_paid'];
        $validPaymentMethods = ['paymaya', 'gcash'];

        if (!in_array($paymentType, $validPaymentTypes) || !in_array($paymentMethod, $validPaymentMethods)) {
            throw new Exception("Invalid payment details provided.");
        }

        // Check if already paid
        if ($booking['payment_type']) {
            echo "<script>
                    alert('Payment already processed for this booking.');
                    window.location.href = 'Room.php';
                  </script>";
            exit();
        }

        // Update payment details
        $updateStmt = $pdo->prepare("
            UPDATE bookings 
            SET payment_type = :payment_type, payment_method = :payment_method 
            WHERE booking_id = :booking_id
        ");
        $updateStmt->bindParam(':payment_type', $paymentType);
        $updateStmt->bindParam(':payment_method', $paymentMethod);
        $updateStmt->bindParam(':booking_id', $bookingId, PDO::PARAM_INT);

        if ($updateStmt->execute()) {
            echo "<script>
                    alert('Payment Successful!');
                    window.location.href = 'Room.php';
                  </script>";
            exit();
        } else {
            throw new Exception("Failed to update payment details.");
        }
    }
} catch (Exception $e) {
    error_log("Error: " . $e->getMessage());
    echo "<script>alert('An error occurred. Please try again later.');</script>";
    exit();
}
?>








<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Payment</title>
    <link rel="stylesheet" href="style1.css">
    <style>
    /* Existing CSS */
    .profile-circle {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        overflow: hidden;
        display: inline-block;
        margin-right: 10px;
        background-color: #ccc;
        position: relative;
    }

    .profile-circle img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .user-dropdown {
        position: relative;
        display: inline-block;
        cursor: pointer;
    }

    .user-info {
        display: flex;
        align-items: center;
        color: white;
        text-decoration: none;
        font-family: 'Times New Roman';
        font-weight: lighter;
    }

    .dropdown-menu {
        display: none;
        position: absolute;
        top: 60px;
        right: 10px;
        background-color: #f8f8f8;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        border-radius: 5px;
        z-index: 10;
        width: 200px;
        padding: 10px 0;
    }

    .dropdown-menu ul {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .dropdown-menu li {
        padding: 10px 20px;
        white-space: nowrap;
        transition: background-color 0.3s ease;
    }

    .dropdown-menu li:hover {
        background-color: #c29201;
        cursor: pointer;
    }

    .dropdown-menu a {
        text-decoration: none;
        color: #333;
        display: flex;
        align-items: center;
    }

    /* Payment Section Styles */
    .payment-container {
        background-color: #fff;
        width: 400px;
        margin: 20px auto;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        text-align: center;
    }

    .payment-container h1 {
        font-size: 24px;
        color: #c29201;
        margin-bottom: 10px;
    }

    .payment-container p {
        margin: 5px 0;
    }

    .payment-buttons {
        display: flex;
        justify-content: center;
        margin: 20px 0;
    }

    .payment-buttons button {
        background-color: #fff;
        border: 2px solid #000;
        padding: 10px 20px;
        font-size: 16px;
        cursor: pointer;
        transition: all 0.3s;
        margin: 0 10px;
        font-weight: bold;
    }

    .payment-buttons button.active {
        background-color: #c29201;
        color: #fff;
        border: none;
    }

    .payment-options {
        text-align: left;
        margin: 20px 0;
    }

    .payment-options input {
        margin-right: 10px;
    }

    .confirm-button {
        background-color: #c29201;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .confirm-button:hover {
        background-color: #9b7300;
    }

    .terms {
        margin-top: 15px;
        font-size: 12px;
        color: #333;
    }

    .terms a {
        text-decoration: none;
        color: #c29201;
        font-weight: bold;
    }
    .logo img {
            max-width: 150px;
            margin-bottom: 10px;
            display: block;
            margin-left: auto;
            margin-right: auto;
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
                            <img src="fam.jpg" alt="Profile Picture">
                        </div>
                        <span><?= htmlspecialchars($_SESSION['first_name'] . ' ' . $_SESSION['last_name']) ?></span>
                    </div>
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
        <div class="logo">
            <h1>Casa Estela</h1>
            <p>- A Place to Call Home</p>
        </div>
    </header>

    <div class="payment-container">
        <div class="logo">
            <img src="casa.jpg" alt="CASA ESTELA Logo">
        </div>
        <h1>Payment Details</h1>
        <p><strong>Room Type:</strong> <?= $roomType; ?></p>
        <p><strong>Total Price:</strong> PHP <?= $formattedPrice; ?></p>

        <form method="POST">
            <!-- Payment Type Selection -->
            <label>Payment Type:</label><br>
            <label>
                <input type="radio" name="payment_type" value="downpayment" checked>
                Downpayment ( PHP <?= $formattedDownpayment; ?>)
            </label><br>
            <label>
                <input type="radio" name="payment_type" value="fully_paid">
                Fully Paid ( PHP <?= $formattedPrice; ?>)
            </label><br><br>

            <!-- Payment Method Selection -->
            <div class="payment-buttons">
                <button type="button" id="paymaya" class="active" onclick="selectPaymentMethod('paymaya')">PayMaya</button>
                <button type="button" id="gcash" onclick="selectPaymentMethod('gcash')">G-Cash</button>
            </div>

            <!-- Hidden Field for Payment Method -->
            <input type="hidden" name="payment_method" id="payment_method" value="paymaya">

            <!-- Confirm Payment Button -->
            <button type="submit" class="confirm-button" name="confirm_payment">Confirm Payment</button>
        </form>
    </div>

    <script>
        function selectPaymentMethod(method) {
            // Toggle active button class
            document.querySelectorAll('.payment-buttons button').forEach(btn => btn.classList.remove('active'));
            document.getElementById(method).classList.add('active');
            document.getElementById('payment_method').value = method;
        }

        document.querySelector('form').addEventListener('submit', function (e) {
            const paymentMethod = document.getElementById('payment_method').value;
            if (!paymentMethod) {
                e.preventDefault();
                alert('Please select a payment method.');
            }
        });
    </script>

</body>
</html>
