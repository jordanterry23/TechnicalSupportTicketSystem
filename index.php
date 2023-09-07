<?php 
    $title = "Debug Page";
    include "header.php"
?>
<h2>Show All Users:</h2>
<?php
    $db->showUsers();
?>

<h2>Select User:</h2>
<?php
    //$db->findUserFname("Jason");
    include "finduser.php";
?>

<h2>Show Tickets:</h2>
<?php
    $db->showAllTickets();
?>
<?php include "footer.php" ?>