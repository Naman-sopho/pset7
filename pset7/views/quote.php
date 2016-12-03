<?php
    // check if user input is a valid stock symbol
    if ($stock = lookup(htmlspecialchars($_POST["symbol"]))) 
    {
        $price = number_format($stock["price"], $decimal = 2);
        echo("<h3>The current price of {$stock["name"]}({$stock["symbol"]}) is \${$price} ");echo("</h3>");
    }
    
    else
    {
        echo("<h1>Sorry!");echo("</h1>");
        echo("<h4>Please enter a valid Stock symbol.");echo("</h4>");
    }
?>