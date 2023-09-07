<?php 
    $title = "Create Support Ticket";
    include "header.php";
    if(empty($_SESSION) || !isset($_SESSION))
    {
        session_destroy();
        header('Location: login.php');
    }
?>
<div class="containter m-3">
<h2>Create Ticket</h2>
<div id="alertBox" style="display: none"></div>
<form method="POST" id="createTicketForm" onsubmit="return FormValidation.validateTicketCreation()">
    <div class="mb-3">
        <label class="form-label" for="selection">Device Type:</label>
        <select class="form-select" type="select" name="deviceType">
            <option selected value="0">&lt;Device Type&gt;</option>
            <?php
                $types = $db->getDeviceTypes();
                foreach($types as $type)
                {
                    print("<option value='".$type['device_type_id']."'>".$type['device_type']."</option>");
                }
            ?>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label" for="description">Description:</label>
        <textarea class="form-control"name='description' maxlength=500 rows="5"></textarea>
    </div>
    <button class="btn btn-primary" value="Submit Ticket">Submit Ticket</button>
</form>
</div>

<?php 
    if(isset($_POST) && !empty($_POST))
    {

        $error = false;
        $errorMsg = "";
        $deviceType = $_POST['deviceType'];
        $description = $_POST['description'];
        $userID = $_SESSION['userID'];

        if(!$error){

            if($db->createTicket($userID, $deviceType, $description)){
            echo("<script>
                alertBox = new AlertBox('Your ticket has been submitted!', 'success').show();
            </script>");
            }
            
        }
        else
        {
            echo($errorMsg);
        }
            
    }
?>
<?php include "footer.php"?>