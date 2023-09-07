<?php 
    $title = "Update Ticket";
    include "header.php";
    if(empty($_SESSION) || !isset($_SESSION))
    {
        session_destroy();
        header('Location: login.php');
    }
?>
<div class="container m-3">
<div id="alertBox" style="display:none"></div>
<?php
if(isset($_POST) && !empty($_POST))
    {

        $error = false;
        $errorMsg = "";
        $ticketID = $_POST['ticketID'];
        $status = $_POST['status'];
        $deviceType = $_POST['deviceType'];
        $description = $_POST['description'];

        if(!$error){

            if($db->updateTicket($ticketID, $status, $deviceType, $description))
            {
            echo("<script>
                alertBox = new AlertBox('Ticket has been updated!', 'success').show();
            </script>");
            $ticket = $db->getTicketData($ticketID);
            }
            
        }
        else
        {
            echo($errorMsg);
        }
        
    }
else {
    $ticket = $db->getTicketData($_GET["id"]);
    //print_r($ticket);
}
?>
    <h2>Update Ticket</h2>
    <div class="containter-fluid">
        <form id="updateTicketsForm" method="POST" onsubmit="validateTicketCreation()">
        <input name="ticketID" type="hidden" value ="<?php echo($ticket['ticket_id'])?>" />
        <label class="form-label" for="selection">Ticket Status:</label>
        <select class="form-select" type="select" name="status">
            <?php
                $statuses = $db->showStatusTypes();
                foreach($statuses as $status)
                {
                    if($ticket["status_id"] == $status['status_id'])
                    {
                        print("<option selected value='".$status['status_id']."'>".$status['status']."</option>");    
                    }
                    else{
                        print("<option value='".$status['status_id']."'>".$status['status']."</option>");
                    }
                }
            ?>
        </select>
        <label class="form-label" for="selection">Device Type:</label>
        <select class="form-select" type="select" name="deviceType">
            <option selected value="0">&lt;Device Type&gt;</option>
            <?php
                $types = $db->getDeviceTypes();
                foreach($types as $type)
                {
                    if($ticket["device_type_id"] == $type['device_type_id'])
                    {
                        print("<option selected value='".$type['device_type_id']."'>".$type['device_type']."</option>");    
                    }
                    else{
                        print("<option value='".$type['device_type_id']."'>".$type['device_type']."</option>");
                    }
                }
            ?>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label" for="description">Description:</label>
        <textarea class="form-control"name='description' maxlength=500 rows="5"><?php print($ticket["description"]);?></textarea>
    </div>
    <button class="btn btn-primary" value="Update Ticket">Update Ticket</button>
    </form>
</div>
<?php include "footer.php"?>
