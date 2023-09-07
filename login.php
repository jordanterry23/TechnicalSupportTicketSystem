<?php 
    $title = "Log In";   
    include "header.php"
?>

<div class="container m-3">
    <h2>Login</h2>
    <div id="alertBox" style="display: none"></div>
    <?php 
            if(isset($_POST) && !empty($_POST))
            {
                $email = $_POST['email'];
                $pass = $_POST['password'];
                $error = false;
                $errorMsg = array();

                if(!$db->login($email, $pass))
                {
                    echo("
                        <script>
                            alert = new AlertBox('<strong>ERROR:</strong></br>Incorrect username or password.', 'warning').show();
                        </script>
                    ");
                }


            }
        ?>
    <div class="containter-fluid">
        <form id="loginForm" method="POST" onsubmit="return FormValidation.validateLogin()">
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" name="email" placeholder="name@example.com"/>
            </div>
            <div class="mb-3">
                <label for="password">Password:</label>
                <input type="password" class="form-control" name="password" placeholder="Password"/>
            </div>
            <div class="mb3">
                <button type="Submit" class="btn btn-primary" id='submit'>Login</button>
            </div>
        </form>
    </div>
</div>
<?php include "footer.php"?>