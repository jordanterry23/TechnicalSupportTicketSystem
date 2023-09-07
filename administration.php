<?php 
    $title = "Administration";
    include "header.php";
    if(empty($_SESSION) || !isset($_SESSION))
    {
        session_destroy();
        header('Location: login.php');
    }
?>
<div class="container m-3">
    <h2>Administration</h2>
    <div class="containter-fluid">
    
        <div class="mb-3">
            <?php 
            $db->viewTechs();
        ?>
        </div>
        
        <div class="mb3">
                <button type="Submit" class="btn btn-success" id='add' onclick="window.location='add-technician.php'">Add New Technician</button>
        </div>
    
</div>
<?php include "footer.php"?>
