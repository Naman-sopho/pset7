<?php

    // configuration
    require("../includes/config.php");

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("register_form.php", ["title" => "Register"]);
    }

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // validate submissions
        if(empty($_POST["username"]))
            apologize("You must provide a username. 
            Click <a href = \"register.php\">here </a>to go back to the registration page.");

        else if(empty($_POST["password"]))
            apologize("You must provide a password. 
            Click <a href = \"register.php\">here </a>to go back to the registration page.");
        
        // compare password and confirmation
        if($_POST["password"] != $_POST["confirmation"])
            apologize("Those passwords do not match. 
            Click <a href = \"register.php\">here </a>to go back to the registration page.");
        
        // if validated add new user to the table
        $rows = CS50::query("INSERT IGNORE INTO users (username, hash, cash) VALUES(?, ?, 10000.0000)",
        $_POST["username"], password_hash($_POST["password"], PASSWORD_DEFAULT));
        
        if ($rows !== 1)
            {
                apologize("Username already taken. 
                Click <a href = \"register.php\">here </a>to go back to the registration page.");
            }
        
        // redirect the new user to their portfolio    
        else
            {
                $rows = CS50::query("SELECT LAST_INSERT_ID() AS id");
                $id = $rows[0]["id"];
                
                $_SESSION["id"] = $id;
                redirect("/");
            }
    }

?>