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
    <title>Rooms</title>
    <link rel="stylesheet" href="style1.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
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
.modal {
    display: none;
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

   


<div class="room-container">
    <div class="room-card">
        <div class="room-images">
            <img src="standard1.jpg" alt="Standard Room Image 1">
            <img src="stadard2.jpg" alt="Standard Room Image 2">
            <img src="stadardcr.jpg" alt="Standard Room Image 3">
        </div>
        <h3>Standard Double Room</h3>
        <p class="price">₱ 3,600 per night</p>
        <p class="description">The double room features air conditioning, tumble dryer, as well as a private bathroom boasting a shower and a bidet. This double room provides a tiled floor and a flat-screen TV. The unit has 2 beds <a href="#" id="view-more-standard">view more...</a></p>
    </div>
    <div class="room-card">
        <div class="room-images">
            <img src="family1.jpg" alt="Family Room Image 1">
            <img src="family2.jpg" alt="Family Room Image 2">
            <img src="familycr.jpg" alt="Family Room Image 3">
        </div>
        <h3>Family Room</h3>
        <p class="price">₱ 4,600 per night</p>
        <p class="description">The family room provides air conditioning, tumble dryer, as well as a private bathroom featuring a shower and a bidet. This family room features a tiled floor and a flat-screen TV <a href="#" class="view-more" data-target="#familyRoomModal">view more...</a></p>
    </div>
    <div class="room-card">
        <div class="room-images">
            <img src="deluxe1.jpg" alt="Deluxe Room Image 1">
            <img src="deluxe2.jpg" alt="Deluxe Room Image 2">
            <img src="deluxecr.jpg" alt="Deluxe Room Image 3">
        </div>
        <h3>Deluxe Family Room</h3>
        <p class="price">₱ 5,500 per night</p>
        <p class="description">The family room offers air conditioning, tumble dryer, as well as a private bathroom boasting a shower and a bidet. This family room offers a tiled floor and a flat-screen TV. The unit has 2 beds <a href="#" class="view-more" data-target="#deluxeFamilyRoomModal">View More</a>

</p>
    </div>
</div>


<div id="roomModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <div class="modal-details">
            <div class="modal-images">
                <button class="prev-image">&#8249;</button>
                <img src="standard1.jpg" alt="Room Main" id="mainImage">
                <button class="next-image">&#8250;</button>
                <div class="thumbnail-container">
                    <img src="standard1.jpg" alt="Thumbnail 1" class="thumbnail" onclick="changeImage(this)">
                    <img src="stadard2.jpg" alt="Thumbnail 2" class="thumbnail" onclick="changeImage(this)">
                    <img src="standard3.jpg" alt="Thumbnail 3" class="thumbnail" onclick="changeImage(this)">
                    <img src="standard4.jpg" alt="Thumbnail 4" class="thumbnail" onclick="changeImage(this)">
                    <img src="stadardcr.jpg" alt="Thumbnail 4" class="thumbnail" onclick="changeImage(this)">
                </div>
            </div>
            <div class="modal-info">
                <h2>Standard Double Room</h2>
                <p><strong>2 Single Beds</strong></p>
                <p>⭐⭐⭐⭐⭐</p>
                <p>
                    <span>❄️ Air Conditioning</span>
                    <span>🛁 Private Bathroom</span>
                    <span>📺 Flat-screen TV</span>
                    <span>📶 Free Wi-Fi</span>
                    <span>🚭 No Smoking</span>
                </p>
                <p>The double room features air conditioning, a tumble dryer, as well as a private bathroom boasting a shower and a bidet. This double room provides a tiled floor and a flat-screen TV.</p>
                <ul>
    <li>✔️ Shower</li>
    <li>✔️ Bidet</li>
    <li>✔️ Toilet</li>
    <li>✔️ Desk</li>
    <li>✔️ Flat-screen TV</li>
    <li>✔️ Tile/marble floor</li>
    <li>✔️ Clothes dryer</li>
    <li>✔️ Trash cans</li>
    <li>✔️ Slippers</li>
    <li>✔️ Toilet paper</li>
    <li>✔️ Hairdryer</li>
    <li>✔️ Air conditioning</li>
    <li>✔️ Hand sanitizer</li>
    <li>✔️ Clothes rack</li>
    <li>✔️ Single-room air conditioning</li>
    <li>✔️ Free bottled water</li>
</ul>

<div class="bottom-right">
    <p><strong>No Refund ❌</strong></p>
    <p>Breakfast included in the price!</p>
    <p class="price">₱3,600 for 1 night</p>
    <a href="rmbooking.php">
    <button class="book-button">Book Now!</button>
</a>
</div>

            </div>
        </div>
        <div class="chat-container">
            <div class="chat">
                <input type="text" placeholder="Can I have additional pillows?" />
                <button>Send</button>
            </div>
            <div class="add-ons">
                <button>+ Lunch</button>
                <button>+ Dinner</button>
            </div>
        </div>
        
    </div>
</div>

<div id="familyRoomModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <div class="modal-details">
            <div class="modal-images">
                <button class="prev-image">&#8249;</button>
                <img src="family1.jpg" alt="Room Main" id="mainImage">
                <button class="next-image">&#8250;</button>
                <div class="thumbnail-container">
                    <img src="family1.jpg" alt="Thumbnail 1" class="thumbnail" onclick="changeImage(this)">
                    <img src="family2.jpg" alt="Thumbnail 2" class="thumbnail" onclick="changeImage(this)">
                    <img src="familycr.jpg" alt="Thumbnail 3" class="thumbnail" onclick="changeImage(this)">
                </div>
            </div>
            <div class="modal-info">
                <h2>Family Room</h2>
                <p><strong>1 King Bed & 2 Twin Beds</strong></p>
                <p>⭐⭐⭐⭐⭐</p>
                <p>
                    <span>❄️ Air Conditioning</span>
                    <span>🛁 Private Bathroom</span>
                    <span>📺 Flat-screen TV</span>
                    <span>📶 Free Wi-Fi</span>
                    <span>🚭 No Smoking</span>
                </p>
                <p>The family room provides air conditioning, a tumble dryer, and a private bathroom featuring a shower and bidet. This family room is spacious and equipped with a flat-screen TV.</p>
                <ul>
                    <li>✔️ Shower</li>
                    <li>✔️ Bidet</li>
                    <li>✔️ Toilet</li>
                    <li>✔️ Desk</li>
                    <li>✔️ Flat-screen TV</li>
                    <li>✔️ Tile/marble floor</li>
                    <li>✔️ Clothes dryer</li>
                    <li>✔️ Slippers</li>
                    <li>✔️ Toilet paper</li>
                    <li>✔️ Hairdryer</li>
                    <li>✔️ Air conditioning</li>
                    <li>✔️ Hand sanitizer</li>
                    <li>✔️ Clothes rack</li>
                    <li>✔️ Free bottled water</li>
                </ul>

                <div class="bottom-right">
                    <p><strong>No Refund ❌</strong></p>
                    <p>Breakfast included in the price!</p>
                    <p class="price">₱4,600 for 1 night</p>
                    <a href="rmbooking.php">
        <button class="book-button">Book Now!</button>
                    </a>
                </div>
            </div>
        </div>
        <div class="chat-container">
            <div class="chat">
                <input type="text" placeholder="Can we request an extra bed?" />
                <button>Send</button>
            </div>
            <div class="add-ons">
                <button>+ Lunch</button>
                <button>+ Dinner</button>
            </div>
        </div>
    </div>
</div>

<div id="deluxeFamilyRoomModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <div class="modal-details">
            <div class="modal-images">
                <button class="prev-image">&#8249;</button>
                <img src="deluxe1.jpg" alt="Room Main" id="deluxeMainImage">
                <button class="next-image">&#8250;</button>
                <div class="thumbnail-container">
                    <img src="deluxe1.jpg" alt="Thumbnail 1" class="thumbnail" onclick="changeDeluxeImage(this)">
                    <img src="deluxe2.jpg" alt="Thumbnail 2" class="thumbnail" onclick="changeDeluxeImage(this)">
                    <img src="deluxecr.jpg" alt="Thumbnail 3" class="thumbnail" onclick="changeDeluxeImage(this)">
                </div>
            </div>
            <div class="modal-info">
                <h2>Deluxe Family Room</h2>
                <p><strong>1 King Bed & 1 Double Bed</strong></p>
                <p>⭐⭐⭐⭐⭐</p>
                <p>
                    <span>❄️ Air Conditioning</span>
                    <span>🛁 Private Bathroom with Bathtub</span>
                    <span>📺 Smart TV</span>
                    <span>📶 Free Wi-Fi</span>
                    <span>🚭 No Smoking</span>
                </p>
                <p>This deluxe family room features modern furnishings, a private balcony, and luxurious amenities, including a bathtub and a Smart TV.</p>
                <ul>
                    <li>✔️ Bathtub</li>
                    <li>✔️ Shower</li>
                    <li>✔️ Bidet</li>
                    <li>✔️ Mini-bar</li>
                    <li>✔️ Smart TV</li>
                    <li>✔️ Tile/marble floor</li>
                    <li>✔️ Wardrobe</li>
                    <li>✔️ Bathrobes</li>
                    <li>✔️ Hairdryer</li>
                    <li>✔️ Air conditioning</li>
                    <li>✔️ Coffee machine</li>
                    <li>✔️ Free bottled water</li>
                </ul><br>

                <div class="bottom-right">
                    <p><strong>No Refund ❌</strong></p>
                    <p>Breakfast included in the price!</p>
                    <p class="price">₱6,200 for 1 night</p>
                    <a href="rmbooking.php">
    <button class="book-button">Book Now!</button>
</a>
                </div>
            </div>
        </div>
        <div class="chat-container">
            <div class="chat">
                <input type="text" placeholder="Can we get a baby cot?" />
                <button>Send</button>
            </div>
            <div class="add-ons">
                <button>+ Wine</button>
                <button>+ Dinner</button>
            </div>
        </div>
    </div>
</div>


  

  
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="script.js"></script>
</body>
</html>
