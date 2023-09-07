<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
        <!--<link rel="stylesheet" href="style.css" />-->
        <?php
                include "dbcontroller.php";
                session_start();
            ?>
        <title><?php print($title)?></title>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
        <script src="AlertBox.js"></script>
        <script src="FormValidation.js"></script>
    </head>
    <body>

    <?php 
        $db = new db();
    ?>
    <nav class="navbar navbar-expand-lg bg-body-secondary">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuItems" aria-controls="menuItems" aria-expanded="false" aria-label="Toggle Navigation">
                <span class="navbar-toggler-icon"></span>    
            </button>
            <a class="navbar-brand" href="index.php">Tech Support</a>
            <div class="collapse navbar-collapse" id="menuItems">
                <ul class="navbar-nav me-auto mb2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">Home</a>
                    </li>
                    <?php 
                        if(isset($_SESSION) && !empty($_SESSION))
                        {
                            echo("
                                <li class='nav-item'>
                                    <a class='nav-link active' href='create-ticket.php'>Create Ticket</a>
                                </li>
                            ");

                            if($_SESSION["userType"] == $db->getUserTypeID("Student") || $_SESSION["userType"] == $db->getUserTypeID("Faculty")){
                                echo("
                                    <li class='nav-item'>
                                        <a class='nav-link active' href='ticket-status.php'>Ticket Status</a>
                                    </li>
                                ");
                            }

                            if($_SESSION["userType"] == $db->getUserTypeID("Technician") || $_SESSION["userType"] == $db->getUserTypeID("Manager"))
                            {
                                echo("
                                    <li class='nav-item'>
                                        <a class='nav-link active' href='tickets.php'>Tickets</a>
                                    </li>
                                ");    
                            }
                            
                            if($_SESSION["userType"] == $db->getUserTypeID("Manager"))
                            {
                                echo("
                                    <li class='nav-item'>
                                        <a class='nav-link active' href='administration.php'>Administration</a>
                                    </li>
                                ");
                            }

                            echo("
                                <li class='nav-item'>
                                    <a class='nav-link active' href='logout.php'>Logout</a>
                                </li>
                            ");
                        }
                        else{
                            
                            echo("
                                <li class='nav-item'>
                                    <a class='nav-link active' href='user-registration.php'>Register</a>
                                </li>
                                <li class='nav-item'>
                                    <a class='nav-link active' href='login.php'>Login</a>
                                </li>
                            ");
                        }
                    ?>
                </ul>
                <?php 
                    if(isset($_SESSION) && !empty($_SESSION)){
                        echo("
                            <span class='navbar-text'>
                                Welcome, ".$db->getUserFullName($_SESSION['userID'])."!
                            </span>
                        ");
                    }
                ?>
            </div>
        </div>
    </nav>
    <div class="container">