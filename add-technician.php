<?php 
        $title = "Add Technician";
        include "header.php";
    ?>
    
    <div class="containter m-3">
        <h2>Add Techncian</h2>
        <div id="alertBox" style="display:none"></div>
        <?php 
        $fname = "";
        $lname = "";
        $email = "";
        $pass = "";
        $confirmPass = "";
        $phone = "";

        if(isset($_POST) && !empty($_POST)) 
        {    
            if(key_exists("fName", $_POST)){
                $fname = $_POST['fName'];
            }
            if(key_exists("lName", $_POST)){
                $lname = $_POST['lName'];
            }
            if(key_exists("email", $_POST)){
                $email = $_POST['email'];
            }
            if(key_exists("pass", $_POST)){
                $pass = $_POST['pass'];
            }
            if(key_exists("confirmPass", $_POST)){
                $confirmPass = $_POST['confirmPass'];
            }
            if(key_exists("phone", $_POST)){
                $phone = $_POST['phone'];
            }


            try{
                $db->addNewTech($fname, $lname, $email, $pass, $phone);
                echo("
                <script>
                    alertBox = new AlertBox('Technician added successfully.', 'success');
                    alertBox.show();
                </script>"
            );
            }
            catch(Exception $e)
            {
                $error = true;
                echo("
                <script>
                    alertBox = new AlertBox('This technician already exists.', 'danger');
                    alertBox.show();
                </script>"
            );
            }
            

        }

        ?>  
        <div class="container-fluid">
            <form method="POST" id="techRegistrationForm" onsubmit="return FormValidation.validateTechRegistration()">
                <div class="mb-3">
                    <label class="form-label" for="fName"><span style="color:red">*</span>First Name:</label>
                    <input class="form-control" type="text" name="fName" placeholder="First Name" value="<?php print($fname); ?>"/>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="lName"><span style="color:red">*</span>Last Name:</label>
                    <input class="form-control" type="text" name="lName" placeholder="Last Name" value="<?php print($lname); ?>"/>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="email"><span style="color:red">*</span>Email:</label>
                    <input class="form-control" type="email" name="email" placeholder="Email Address" value="<?php print($email); ?>"/>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="phone">Phone:</label>
                    <input class="form-control" type="text" name="phone" placeholder="Phone Number"value="<?php print($phone); ?>"/>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="pass"><span style="color:red">*</span>Password:</label>
                    <input class="form-control" type="password" name="pass" placeholder="Password" value="<?php print($pass); ?>"/>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="confirmPass"><span style="color:red">*</span>Confirm Password:</label>
                    <input class="form-control" type="password" name="confirmPass" placeholder="Confirm Password" value="<?php print($confirmPass); ?>"/>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Register</button>
                </div>
                <div class="mb-3 form-text">
                    All fields marked with <span style="color:red">*</span> are required.
                </div>
            </form>
        </div>
    </div>
    </body>

</html>