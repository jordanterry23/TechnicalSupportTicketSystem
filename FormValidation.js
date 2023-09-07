class FormValidation{
    static validateLogin()
    {
        let email = document.forms["loginForm"]["email"].value;
        let password = document.forms["loginForm"]["password"].value;
        let error = false;
        let errorMsg = "<strong>ERROR:</strong></br>";

        if (email == null || email == "")
        {
            error = true;
            errorMsg += "Please enter your email.</br>"
        }

        if(password == null || password == "")
        {
            error=true;
            errorMsg += "Please enter your password."
        }

        if (error)
        {
            let alertBox = new AlertBox(errorMsg, "warning");
            alertBox.show();
            return false;
        }
        else{
            return true;
        }

    }

    static validateRegistration()
    {
        let userType = document.forms["userRegistrationForm"]["userType"];
        let fName = document.forms["userRegistrationForm"]["fName"].value;
        let lName = document.forms["userRegistrationForm"]["lName"].value;
        let email = document.forms["userRegistrationForm"]["email"].value;
        let pass = document.forms["userRegistrationForm"]["pass"].value;
        let confirmPass = document.forms["userRegistrationForm"]["confirmPass"].value;
        let error = false;
        let errorMsg = "<strong>ERROR:</strong></br>";

        // console.log(userType[1].checked);
        // console.log("Test");

        if(userType[0].checked == false && userType[1].checked == false)
        {
            error = true;
            errorMsg += "Please select Student or Faculty.</br>";
        }
        
        if(fName == null || fName == "")
        {
            error = true;
            errorMsg += "Please enter your first name.</br>";
        }

        if(lName == null || lName == "")
        {
            error = true;
            errorMsg += "Please enter your last name.</br>";
        }

        if(email == null || email == "")
        {
            error = true;
            errorMsg += "Please enter a valid email address.</br>";
        }

        if(pass == null || pass == "")
        {
            error = true;
            errorMsg += "Please enter a password</br>";
        }
        
        if(confirmPass == null || confirmPass == "")
        {
            error = true;
            errorMsg += "Please confirm your password</br>";
        }

        if(confirmPass != pass)
        {
            error = true;
            errorMsg += "Your passwords do not match. Please try again.</br>";
        }

        if(error)
        {
            let alertBox = new AlertBox(errorMsg, 'warning'); 
            alertBox.show();
        return false;
        }

        else
        {
            return true;
        }

    }

    static validateTechRegistration()
    {
        let fName = document.forms["techRegistrationForm"]["fName"].value;
        let lName = document.forms["techRegistrationForm"]["lName"].value;
        let email = document.forms["techRegistrationForm"]["email"].value;
        let pass = document.forms["techRegistrationForm"]["pass"].value;
        let confirmPass = document.forms["techRegistrationForm"]["confirmPass"].value;
        let error = false;
        let errorMsg = "<strong>ERROR:</strong></br>";

        // console.log(userType[1].checked);
        // console.log("Test");
        
        if(fName == null || fName == "")
        {
            error = true;
            errorMsg += "Please enter your first name.</br>";
        }

        if(lName == null || lName == "")
        {
            error = true;
            errorMsg += "Please enter your last name.</br>";
        }

        if(email == null || email == "")
        {
            error = true;
            errorMsg += "Please enter a valid email address.</br>";
        }

        if(pass == null || pass == "")
        {
            error = true;
            errorMsg += "Please enter a password</br>";
        }
        
        if(confirmPass == null || confirmPass == "")
        {
            error = true;
            errorMsg += "Please confirm your password</br>";
        }

        if(confirmPass != pass)
        {
            error = true;
            errorMsg += "Your passwords do not match. Please try again.</br>";
        }

        if(error)
        {
            let alertBox = new AlertBox(errorMsg, 'warning'); 
            alertBox.show();
        return false;
        }

        else
        {
            return true;
        }

    }

    static validateTechUpdate()
    {
        let fName = document.forms["editTechForm"]["fName"].value;
        let lName = document.forms["editTechForm"]["lName"].value;
        let email = document.forms["editTechForm"]["email"].value;
        let pass = document.forms["editTechForm"]["pass"].value;
        let confirmPass = document.forms["editTechForm"]["confirmPass"].value;
        let error = false;
        let errorMsg = "<strong>ERROR:</strong></br>";

        // console.log(userType[1].checked);
        // console.log("Test");
        
        if(fName == null || fName == "")
        {
            error = true;
            errorMsg += "Please enter your first name.</br>";
        }

        if(lName == null || lName == "")
        {
            error = true;
            errorMsg += "Please enter your last name.</br>";
        }

        if(email == null || email == "")
        {
            error = true;
            errorMsg += "Please enter a valid email address.</br>";
        }

        if(pass == null || pass == "")
        {
            error = true;
            errorMsg += "Please enter a password</br>";
        }
        
        if(confirmPass == null || confirmPass == "")
        {
            error = true;
            errorMsg += "Please confirm your password</br>";
        }

        if(confirmPass != pass)
        {
            error = true;
            errorMsg += "Your passwords do not match. Please try again.</br>";
        }

        if(error)
        {
            let alertBox = new AlertBox(errorMsg, 'warning'); 
            alertBox.show();
        return false;
        }

        else
        {
            alert("testing");
        }

    }

    static validateTicketCreation()
    {
        let deviceType = document.forms["createTicketForm"]["deviceType"].value;
        console.log(deviceType);
        let description = document.forms["createTicketForm"]["description"].value;
        let error = false;
        let errorMsg = "<strong>ERROR:</strong></br>";

        if (deviceType == null || deviceType <= 0)
        {
            error = true;
            errorMsg += "Please select a device type.</br>"
        }

        if(description == null || description == "")
        {
            error=true;
            errorMsg += "Please describe your problem.";
        }

        if (error)
        {
             let alertBox = new AlertBox(errorMsg, "warning");
             alertBox.show();
            return false;
        }
        else{
            return true;
        } 
    }
}