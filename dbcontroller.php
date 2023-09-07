<?php
    class db {

        #region variables
        private $host = "localhost";
        private $user = "techsupport";
        private $pwd = "supportme";
        private $db = "techsupport";
        public $conn;
        #endregion

    #region Constructors and Destructors
        // Constructors and Destructors
        function __construct()
        {
            $this->conn = new mysqli($this->host, $this->user, $this->pwd, $this->db) 
            or 
            die("There was an error: ".$this->conn->connect_error);
            //echo "I have been constructed. </br>";
        }

        function __destruct()
        {
            $this->conn->close();
            //echo "I have been destroyed.</br>";
        }
    #endregion

    #region User Functions
        function addNewUser($fname, $lname, $email, $pass, $phone, $type)
        {
            $typeID = $this->getUserTypeID($type);
            $stmt = $this->conn->prepare("INSERT INTO USERS(first_name, last_name, email, password, phone_number, user_type) VALUES(?, ?, ?, ?, ?, ?)");
            $stmt->bind_param('ssssss', $fname, $lname, $email, $pass, $phone, $typeID);

            if($stmt->execute())
            {
                print("User added successfully");
            }
            else
            {
                print("An error occurred: ".$stmt."</br>".$this->conn->connect_error);
            }

            $stmt->close();

        }    

        function showUsers()
        {
            $sql = "SELECT * FROM view_users";

            $result = $this->conn->query($sql);
            if($result->num_rows > 0)
            {
                $this->generateTable($result);
            }
        }

        function findUserFname($firstName)
        {
            $sql = "SELECT * FROM users WHERE users.first_name LIKE '%".$firstName."%'";

            $result = $this->conn->query($sql);
            if($result->num_rows > 0){
                $this->generateTable($result);
            }
            else
            {
            print("No user can be found with that criteria.");
            }
        }

        function login($email, $pass)
        {
            //$userTypeID = "";
            $stmt = $this->conn->prepare("SELECT user_id, email, password, user_type from users where email = ? and password = ? LIMIT 1");
            $stmt->bind_param("ss", $email, $pass);
            $stmt->execute();
            $stmt->bind_result($id, $email, $pass, $userTypeID);
            $stmt->store_result();
            if($stmt->num_rows() == 1)
            {
                $stmt->fetch();
                //session_start();
                $_SESSION['userID'] = $id;
                $_SESSION['userType'] = $userTypeID;
                print("Session Started.");
                print_r($_SESSION);
                header("Location: index.php");

            }
            else
            {
                return false;
            }
            $stmt->close();
        }

        function logout()
        {
            session_unset();
            session_destroy();
            header("Location: index.php");
        }
        
    #endregion

    #region Ticket Functions
        function showAllTickets()
        {
            //$sql = "SELECT * FROM tickets";
            $sql = "CALL show_all_tickets()";

            $result = $this->conn->query($sql);
            if($result->num_rows > 0)
            {
                $this->generateTable($result, true);
                // print_r($result->fetch_assoc());
                // echo("</br>");
            }
            else
            {
                print("<p>Tickets table is empty.</p>");
            }
        }

        function showUserTickets($userID)
        {
            $sql = "SELECT * FROM tickets WHERE user_id = ".$userID;

            $result = $this->conn->query($sql);
            if($result->num_rows > 0)
            {
                $this->generateTable($result);
                // print_r($result->fetch_assoc());
                // echo("</br>");
            }
            else
            {
                print("<p>Tickets table is empty.</p>");
            }
        }

        function showTechTickets($id)
        {
            $sql = "CALL show_tech_tickets($id)";
            $result = $this->conn->query($sql);
            if($result)
            {
                $this->generateSelectTable($result, "update-ticket.php","id", "ticket_id");
            }
            else
            {
                print("<p>No tickets have been assigned yet, please try again later.</p>");
            }

        }

        function createTicket($userID, $deviceType, $description)
        {
            $stmt = $this->conn->prepare("INSERT INTO tickets(user_id, device_type_id, description) VALUES(?, ?, ?)");
            $stmt->bind_param("sss", $userID, $deviceType, $description);
            if($stmt->execute())
            {
                return true;
            }
            else
            {
                echo("An error has occured: ".$stmt->error);
            }
        }

        function updateTicket($id, $status, $deviceType, $description)
        {
            $stmt = $this->conn->prepare("UPDATE `tickets` set `status_id` = ?, `device_type_id` = ?, `description` = ? where `tickets`.`ticket_id` = ?");
            $stmt->bind_param("ssss", $status, $deviceType, $description, $id);
            if($stmt->execute())
            {
                return true;
            }
            else
            {
                echo("An error has occured: ".$stmt->error);
            }
        }

        function showStatusTypes()
        {
            $sql = "SELECT * FROM `status`";
            $result = $this->conn->query($sql);
            if($result->num_rows > 0)
            {
                $statuses = array();
                while($row = mysqli_fetch_assoc($result))
                {
                    array_push($statuses, $row);
                }
                
                return $statuses;
            }
            else{
                print("Machine broke.");
            }
        }

        function getTicketData($id)
        {
            $sql = "SELECT * from `tickets` where ticket_id = $id LIMIT 1";
            return $this->conn->query($sql)->fetch_assoc();
        }
    #endregion

    #region Technician Functions
        function showTechs()
        {
            $sql = "SELECT * FROM technicians";

            $result = $this->conn->query($sql);
            if($result->num_rows > 0)
            {
                $this->generateTable($result);
                // print("
                //     <table>
                //         <tr>
                //             <th>Technician ID</th>
                //             <th>User ID</th>
                //             <th>Manager ID</th>
                //         </tr>
                // ");
                // while($row = mysqli_fetch_assoc($result))
                // {
                //     print("
                //         <tr>
                //             <td>".$row["tech_id"]."</td>
                //             <td>".$row["user_id"]."</td>
                //             <td>".$row["manager_id"]."</td>
                //         </tr>    
                //     ");
                // }

                // print("</table>");
            }
            else
            {
                print("<p>Technicians table is empty.</p>");
            }
        }

        function getUserData($id)
        {
            $sql = "SELECT * from `users` where user_id = $id LIMIT 1";
            return $this->conn->query($sql)->fetch_assoc();
        }

        function viewTechs()
        {   
            $sql = "SELECT * FROM view_technicians";

            $result = $this->conn->query($sql);
            if($result->num_rows > 0)
            {
                $this->generateSelectTable($result, "edit-technician.php", "id", "tech_id");
            }
            else
            {
                print("<p>Technicians table is empty.</p>");
            }
        }

        function addNewTech($fname, $lname, $email, $pass, $phone)
        {
            $typeID = $this->getUserTypeID("technician");
            $stmt = $this->conn->prepare("INSERT INTO USERS(first_name, last_name, email, password, phone_number, user_type) VALUES(?, ?, ?, ?, ?, ?)");
            $stmt->bind_param('ssssss', $fname, $lname, $email, $pass, $phone, $typeID);

            if($stmt->execute())
            {
                print("Technician added successfully");
            }
            else
            {
                print("An error occurred: ".$stmt."</br>".$this->conn->connect_error);
            }

            $stmt->close();

        }    
    #endregion

    #region Manager Functions
        function showManagers()
        {
            $sql = "SELECT * FROM users where user_type = '".$this->getUserTypeID("Manager")."'";

            $result = $this->conn->query($sql);
            if($result->num_rows > 0)
            {
                $this->generateTable($result);
                // print("
                // <table>
                //     <tr>
                //         <th>User ID</th>
                //         <th>First Name</th>
                //         <th>Last Name</th>
                //         <th>Email</th>
                //         <th>Password</th>
                //         <th>Phone</th>
                //     </tr>
                // ");
                // while($row = mysqli_fetch_assoc($result))
                // {
                //     print("
                //         <tr>
                //             <td>".$row["user_id"]."</td>
                //             <td>".$row["first_name"]."</td>
                //             <td>".$row["last_name"]."</td>
                //             <td>".$row["email"]."</td>
                //             <td>".$row["password"]."</td>
                //             <td>".$row["phone_number"]."</td>
                            
                //         </tr>    
                //     ");
                // }

                // print("</table>");
            }
            else
            {
                print("<p>Managers table is empty.</p>");
            }
        }
    #endregion

    #region Notes Functions
        function showNotes()
        {
            $sql = "SELECT * FROM notes";

            $result = $this->conn->query($sql);
            if($result->num_rows > 0)
            {
                print_r($result->fetch_assoc());
                echo("</br>");
            }
            else
            {
                print("<p>Notes table is empty.</p>");
            }
        }
    #endregion

    #region Device Type Functions
        function showDeviceTypes()
        {
            $sql = "SELECT * FROM devicetypes";

            $result = $this->conn->query($sql);
            if($result->num_rows > 0)
            {
                $this->generateTable($result);
                // print("
                // <table>
                //     <tr>
                //         <th>Device Type ID</th>
                //         <th>Device Type</th>
                        
                //     </tr>
                // ");
                // while($row = mysqli_fetch_assoc($result))
                // {
                //     print("
                //         <tr>
                //             <td>".$row["device_type_id"]."</td>
                //             <td>".$row["device_type"]."</td>
                //         </tr>    
                //     ");
                // }

                // print("</table>");
            }
            else
            {
                print("<p>DeviceTypes table is empty.</p>");
            }
        }

        function getDeviceTypes()
        {
            $sql = "SELECT * FROM devicetypes";
            $result = $this->conn->query($sql);
            if($result->num_rows > 0)
            {
                $types = array();
                while($row = mysqli_fetch_assoc($result))
                {
                    array_push($types, $row);
                }
                
                return $types;
            }
            else{
                print("Machine broke.");
            }
            
        }
    #endregion

    #region User Type Functions
        function getUserTypeID($typeName)
        {
            $sql = "SELECT user_type_id from usertypes where user_type = '".$typeName."' LIMIT 1";

            $result = $this->conn->query($sql);

            $userTypeID = $result->fetch_row()[0] ?? false;
            
            if($userTypeID != false)
            {
                return $userTypeID;
            }
            else
            {
                return "Cannot find type";
            }           
        }

        function getUserType($userTypeID)
        {
            $sql = "SELECT user_type from usertypes where user_type_id = '".$userTypeID."' LIMIT 1";
            $result = $this->conn->query($sql);
            $userType = $result->fetch_row()[0] ?? false;

            if($userType != false)
            {
                return $userType;
            }
        }

        function getUserFullName($userID)
        {
            $sql = "SELECT first_name, last_name from users where user_id = '".$userID."' LIMIT 1";
            $result = $this->conn->query($sql);
            $name = $result->fetch_row()[0] ?? false;
            if($name != false)
            {
                return $name;
            }
            else
            {
                return "Guest";
            }
        }
    #endregion

    #region Utility Functions - Move to separate Class?

    function generateTable($data)
    {
        // Create a way to generate tables for all queries, which can be called when needed.
        $fields = mysqli_fetch_fields($data);
        $fieldNames = array();
        
        // Get Table Header Names
        foreach ($fields as $field)
        {
            array_push($fieldNames, $field->name);
        }

        print(
            "<table class='table'>
            <thead>
            <tr>
        ");

        // Get Table Headers, Make Human-Readable
        foreach($fieldNames as $name)
        {
            print("<th scope='col'>".str_replace("Id", "ID", ucwords(str_replace('_', ' ', $name), " "))."</th>");
        }

        print("</tr>
        </thead>
        <tbody>
        ");

        while($row = mysqli_fetch_assoc($data))
        {
            foreach($fieldNames as $name)
            {
                print("<td>".$row[$name]."</td>");
            }
            print("</tr>");
        }

        print("<tbody></table>");
    }

    function generateSelectTable($data, $target="", $id, $key)
    {
        // Create a way to generate tables for all queries, which can be called when needed.
        $fields = mysqli_fetch_fields($data);
        $fieldNames = array();
        
        // Get Table Header Names
        foreach ($fields as $field)
        {
            array_push($fieldNames, $field->name);
        }

        print(
            "<table class='table'>
            <thead>
            <tr>
        ");

        // Get Table Headers, Make Human-Readable
        foreach($fieldNames as $name)
        {
            print("<th scope='col'>".str_replace("Id", "ID", ucwords(str_replace('_', ' ', $name), " "))."</th>");
        }

        print("</tr>
        </thead>
        <tbody>
        ");

        while($row = mysqli_fetch_assoc($data))
        {
            print("
                <tr scope='row' onclick='window.location.href=\"".$target."?".$id."=".$row[$key]."\"' class='selectable'>
            ");
            

            foreach($fieldNames as $name)
            {
                print("<td>".$row[$name]."</td>");
            }
            print("</tr>");
        }

        print("<tbody></table>");
    }

    #endregion

    }
?>