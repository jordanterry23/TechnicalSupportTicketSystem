<?php 
    $title = "Tickets";
    include "header.php";
    if(empty($_SESSION) || !isset($_SESSION))
    {
        session_destroy();
        header('Location: login.php');
    }
?>
<div class="container m-3">
    <h2>Tickets</h2>
    <div class="containter-fluid">
    
        <?php 
        if($_SESSION['userType'] == $db->getUserTypeID("manager"))
        {
            $db->showAllTickets();
        }
        else if ($_SESSION['userType']==$db->getUserTypeID("technician"))
        {
            $db->showTechTickets($_SESSION["userID"]);
        }
        ?>
    
</div>
<?php include "footer.php"?>
