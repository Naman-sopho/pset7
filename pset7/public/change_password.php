<?php

    // configuration
    require("../includes/config.php"); 

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        render("change_password_form.php", ["title" => "Change Password"]);
    }

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $row = CS50::query("SELECT hash FROM users WHERE id = ?", $_SESSION["id"]);
        // validate user's input
        if (empty($_POST["current_password"]))
        {
            apologize("Please fill the current password field. Click <a href = \"change_password.php\">here </a>to go back to the 
            change password page.");
        }
        
        else if (empty($_POST["new_password"]))
        {
            apologize("Please fill the new password field. Click <a href = \"change_password.php\">here </a>to go back to the 
            change password page.");
        }
        
        else if (empty($_POST["confirmation"]))
        {
            apologize("Please retype your new password in the confirmation field. Click <a href = \"change_password.php\">here </a>to go back to the 
            change password page.");
        }
        
        else if ($_POST["new_password"] != $_POST["confirmation"])
        {
            apologize("The new password and its confirmation do not match. Click <a href = \"change_password.php\">here </a>to go back to the 
            change password page.");
        }
        
        else
        {
            if(password_verify($_POST["current_password"], $row["0"]["hash"]))
            {
                CS50::query("UPDATE users SET hash = ? WHERE id = ?", password_hash($_POST["new_password"], PASSWORD_DEFAULT), $_SESSION["id"]);
                render("../views/password_changed.php", ["title" => "Password Changed"]);
            }
            
            else
            {
                apologize("Invalid password. Click <a href = \"change_password.php\">here </a>to go back to the 
            change password page.");
            }
        }
    }
      