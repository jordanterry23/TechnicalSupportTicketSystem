<?php 
    $title = "Ticket Status";
    include "header.php";
    if(empty($_SESSION) || !isset($_SESSION))
    {
        session_destroy();
        header('Location: login.php');
    }
?>
<div class="container m-3">
    <h2>Ticket Status</h2>
    <?php 
        $db->showUserTickets($_SESSION["userID"]);
    ?>
</div>
<?php include "footer.php"?>