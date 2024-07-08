<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Link to external CSS file -->
    <link rel="stylesheet" href="header.css">
    <!-- Links: Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <title>EcoClean</title>
</head>
<body>
    <!-- Navigation Bar -->
    <header>
        <div class="nav">
            <a href="#" class="logo">
                <p>EcoClean:Your Partner in Perfect Laundry </p>
            </a>

            <!-- Menu -->
            <input type="checkbox" name="" id="menu">
            <label for="menu"><i class='bx bx-menu' id="menu-icon"></i></label>
            <nav class="main-nav">
                <ul>
                    <li><a href="elanding.php">Home</a></li>
                    <li><a href="aboutUs.php">About Us</a></li>
                    <li><a href="contacts.php">Contacts</a></li>
                </ul>
            </nav>

            <!-- Account Dropdown -->
            <div class="right-links">
                <div class="dropdown">
                    <button id="dropdownButton">Account</button>
                    <div class="dropdown-content" id="dropdownContent">
                        <a href="logout.php">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </header>
</body>
</html>
