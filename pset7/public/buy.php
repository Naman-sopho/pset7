<?php
    // configuration
    require("../includes/config.php");
    
    // display the form to request a stock quote
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        render("../views/buy_form.php", ["title" => "Buy a stock"]);
    }
    
    // if user is redirected via a POST request
    else if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $symbol = htmlspecialchars(strtoupper($_POST["symbol"]));
        // validate user input
        if (!preg_match("/^\d+$/", $_POST["shares"]))
        {
            apologize("Please enter a valid number of stocks. Click <a href = \"buy.php\">here </a>to go back to the 
            buy stock page.");  
        }
        
        
        // check if user input is a valid stock symbol
        else if (!$stock = lookup("$symbol"))
        {
            apologize("Please enter a valid stock symbol. Click <a href = \"buy.php\">here </a>to go back to the 
            buy stock page.");
        }
        
        else
        {
            $buy["symbol"] = strtoupper($_POST["symbol"]);
            $buy["name"] = $stock["name"];
            $buy["price"] = $stock["price"];
            $buy["shares"] = $_POST["shares"];
            $spent = $buy["price"] * $buy["shares"];
            $buy["spent"] = number_format($spent, 2);
            
            // get user's current cash balance
            $cash = CS50::query("SELECT cash FROM users WHERE id = ?", $_SESSION["id"]);
            
            // check if user has enough balance for the transaction
            if ($spent <= $cash["0"]["cash"])
            {
                // Insert into database the stock bought
                // Insert new row only if user does not already own any shares of the stock
                CS50::query("INSERT INTO portfolios (user_id, symbol, shares) VALUES(?, ?, ?) ON DUPLICATE KEY UPDATE shares = shares + ?",
                $_SESSION["id"], strtoupper($_POST["symbol"]), $_POST["shares"], $_POST["shares"]);
                
                // update users cash balance
                CS50::query("UPDATE users SET cash = cash - ? WHERE id = ?", $spent, $_SESSION["id"]);
                
                // insert transaction into history table
                CS50::query("INSERT INTO history (user_id, symbol, shares, b_or_s, timestamp) VALUES(?, ?, ?, ?, CURRENT_TIMESTAMP)",
                $_SESSION["id"], strtoupper($_POST["symbol"]), $_POST["shares"], -$buy["spent"]);
                
                // get users cash balance
                $cash = CS50::query("SELECT cash FROM users WHERE id = ?", $_SESSION["id"]);
                $buy["cash"] = $cash["0"]["cash"];
                
                render("../views/bought.php", ["buy" => $buy, "title" =>"Bought" . $symbol]);
            }
            
            else
            {
                $more = number_format($spent - $cash["0"]["cash"], 2);
                apologize("You don't have enough balance for this transaction. You require \${$more} more.");
            }
        }
    }
    
?>