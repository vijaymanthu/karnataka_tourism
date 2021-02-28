<?php

session_start();
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary ">
    <div class="container">
        <a class="navbar-brand" href="#">KARNATAKA TOURISM </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item ">
                    <a class="nav-link" href="./admin.php">Home
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Manage
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" id="submenu" href="./tour_packages.php">Tour Packages</a>
                        <a class="dropdown-item" id="submenu" href="./ticket_booking.php">Ticket Booking</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Users</a>

                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">View Cancellation</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">E-Payment</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </div>
    <p class="text-light font-weight-bold pt-3 float-left">
        <?php echo $_SESSION['name']; ?>
    </p>
</nav>