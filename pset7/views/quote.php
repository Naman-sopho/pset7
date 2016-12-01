<?php
    // check if user input is a valid stock symbol
    if ($stock = lookup(htmlspecialchars($_POST["symbol"]))) 
    {
        echo("The current price of {$stock["name"]}({$stock["symbol"]}) is $ {$stock["price"]}");
    }
    
    else
    {
        echo("<h1>Sorry!");echo("</h1>");
        echo("Please enter a valid Stock symbol.");
    }
?>