    <?php 
        $title = "Register";
        include "header.php";
    ?>
    
    <div class="containter m-3">
        <h2>Register</h2>
        <div id="alertBox" style="display:none"></div>
        <?php 
        $fname = "";
        $lname = "";
        $email = "";
        $pass = "";
        $confirmPass = "";
        $phone = "";
        $type = "";

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
            if(key_exists("userType", $_POST)){
                $type = $_POST['userType'];
            }


            try{
                $db->addNewUser($fname, $lname, $email, $pass, $phone, $type);
                echo("
                <script>
                    alertBox = new AlertBox('You have successfully been registered, ".$fname.".', 'success');
                    alertBox.show();
                </script>"
            );
            }
            catch(Exception $e)
            {
                $error = true;
                echo("
                <script>
                    alertBox = new AlertBox('This user already exists.', 'danger');
                    alertBox.show();
                </script>"
            );
            }
            

        }

    // //Error Handling
    // if($error)
    // {
    //     echo("<div class='alert alert-warning mt-3' role='alert'>
    //                 <strong>ERROR:</br></strong>
    //         ");
    //     for($i=0; $i < count($errorMsg); $i++)
    //     {
    //         print($errorMsg[$i]."</br>");
    //     }
    //     print("</div>");

    // }

    #region debug
    // if(isset($_POST) && !empty($_POST))
    // {
    //     print("<p>First Name: ".$fname."</p>");
    //     print("<p>Last Name: ".$lname."</p>");
    //     print("<p>Email Address: ".$email."</p>");
    //     print("<p>Password: ".$pass."</p>");
    //     print("<p>Confirm Password:".$confirmPass."</p>");
    //     print("<p>Phone Number: ".$phone."</p>");
    //     print("<p>Type: ".$type."</p>");
    //     print("<p>Type ID: ".$db->getUserTypeID($type)."</p>");
    //     //print("<p>Type: ".$db->getUserTypeID($type)."</p>");
    // }
    #endregion
?>  
        <div class="container-fluid">
            <form method="POST" id="userRegistrationForm" onsubmit="return FormValidation.validateRegistration()">
                <div class="mb-3">
                    <div class="form-label"> 
                        <span style="color:red">*</span>Are you a student or a faculty member?
                    </div>
                    <input class="form-check-radio" type="radio" name="userType" value="student" <?php if($type=="student"){print("checked");}?>/>
                    <label class="form-check-label" for="userType">Student</label>
                    <input class="form-check-radio" type="radio" name="userType" value="faculty" <?php if($type=="faculty"){print("checked");}?>/>
                    <label class="form-check-label" for="userType">Faculty</label>
                </div>
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