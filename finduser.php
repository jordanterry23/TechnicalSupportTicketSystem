<form method="POST">
    <label for="fName">First Name:</label>
    <input type="text" name="fName" placeholder="First Name"/>
    <input type="submit"/>
</form>
</br>
<?php 
    if(isset($_POST) && !empty($_POST))
    {
        if(key_exists("fName", $_POST)){
            $db->findUserFName($_POST['fName']);
        }
    }
?>