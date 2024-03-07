<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ASELCO</title>
<style>
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f4f4f4;
        color: #333;
    }
    .sidebar {
        height: 100vh;
        width: 250px;
        position: fixed;
        background-color: #FFFFFF;
        color: #ABB1BA;
        box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
    }
    .sidebar-header {
        padding: 20px;
        background-color: #FFFFFF; /* Same as sidebar background */
        color: #333; /* Text color */
        font-size: 20px; /* Adjust font size as needed */
        font-weight: bold;
        border-bottom: 1px solid #f4f4f4; /* Border to match other menu items */
    }
    .sidebar-header span {
        font-size: 12px; /* Set smaller font size for the additional text */
    }

    /* Update .back-arrow to adjust for new header */
    .back-arrow {
        padding: 20px;
        font-size: 18px;
        text-align: left;
        border-bottom: none; /* Remove border if you want the back arrow without a line */
    }

    .menu-item {
        padding: 20px 20px;
        border-bottom: 1px solid #f4f4f4;
        font-size: 16px;
        color: #333;
        display: flex;
        align-items: center;
    }
    .menu-item:hover, .menu-item.active {
        background-color: #4D5B9E;
        color: white;
        cursor: pointer;
    }
    .menu-item .icon {
        font-size: 18px;
        width: 25px;
        margin-right: 10px;
    }
    .content {
        margin-left: 250px;
        padding: 20px;
    }
    
    /* Navbar styles */
    .navbar {
        background-color: #fff;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        height: 50px;
        display: flex;
        justify-content: flex-end;
        align-items: center;
        padding: 0 20px;
        position: fixed;
        width: calc(100% - 250px); /* Sidebar width is 250px */
        left: 250px; /* Sidebar width is 250px */
        top: 0;
        z-index: 100;
    }
    .navbar .logo {
        font-size: 20px;
        font-weight: bold;
    }
    .navbar .user-info {
        background-color: #54609D;
        border-radius: 20px;
        padding: 5px 15px;
        color: white;
        font-weight: bold;
        display: flex;
        align-items: center;
        cursor: pointer;
    }
    .navbar .user-info .user-role {
        margin-right: 5px;
    }
    .navbar .user-info .initials {
        background-color: white;
        color: #54609D;
        border-radius: 50%;
        padding: 2px 7px;
        margin-left: 5px;
        font-weight: bold;
    }
    .content {
        padding-top: 60px; /* Adjust content padding to include navbar */
    }
    .footer {
        position: fixed;
        bottom: 0;
        width: 250px; /* Same as sidebar width */
        background-color: #FFFFFF; /* Same as sidebar background */
        color: #FFFFFF; /* Same as sidebar font color */
        text-align: center;
        padding: 10px 0; /* Adjust padding as needed */
        font-size: 12px; /* Adjust font size as needed */
    }
</style>
</head>
<body>
        <div class="navbar">
            <div class="user-info">
                <span class="initials">S</span>
                <span class="user-role">Super Admin</span>
            </div>
        </div>
        <div class="sidebar">
        <div class="sidebar-header">
            <h2>ASELCO</h2><!-- Move the additional text here -->
            <span>Asynchronous Self Education Learning Code</span> <!-- Keep the original text here -->
        </div>
        <div class="back-arrow">&#x2190;</div>
        <div class="menu-item active">
            <span class="icon">&#x1F3E0;</span>
            <span>Dasbor</span>
        </div>
        <a href="#" class="menu-item"> <!-- Add href attribute with '#' -->
            <span class="icon">&#x2713;</span>
            <span>Data User</span>
        </a>
        <a href="{{ route('schools.index') }}" class="menu-item"> <!-- Add href attribute with '#' -->
            <span class="icon">&#x1F3EB;</span>
            <span>Data Sekolah</span>
        </a>
        <a href="{{ route('CourseControl.index') }}" class="menu-item"> <!-- Add href attribute with '#' -->
            <span class="icon">&#x1F4DA;</span>
            <span>Data Course</span>
        </a>
        <a href="#" class="menu-item"> <!-- Add href attribute with '#' -->
            <span class="icon">&#x1F4C8;</span>
            <span>Rekapitulasi</span>
        </a>
    </div>

    



<script>
    // JavaScript to add 'active' class to the current clicked menu item
    var menuItems = document.querySelectorAll('.menu-item');
    menuItems.forEach(item => {
        item.addEventListener("click", function() {
            document.querySelector('.menu-item.active').classList.remove('active');
            this.classList.add('active');
        });
    });
</script>

</body>
</html>
