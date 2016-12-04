<?php
    // configuration
    require("../includes/config.php");
    
    // display the form to request a stock quote
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        render("../views/quote_form.php", ["title" => "Stock quote"]);
    }
    
    // if user is redirected via a POST request
    else if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        render("../views/quote.php", ["title" => htmlspecialchars( strtoupper($_POST["symbol"]))]);
    }
?>