<?php
    // configuration
    require("../includes/config.php");
    
    // if user reached page via a GET request
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // lookup the current price of all the stocks owned by a user
        $rows = CS50::query("SELECT symbol,shares FROM portfolios WHERE user_id = ?", $_SESSION["id"]);
        $stocks = [];
        foreach ($rows as $row)
        {
            $stock = lookup($row["symbol"]);
            $price = number_format($stock["price"], $decimal = 2);
            $stocks[] = [
                    "name" => $stock["name"],
                    "symbol" => $stock["symbol"],
                    "price" => $price,
                    "shares" => $row["shares"]
                ];
            
        }
        
        render("../views/sell_form.php", ["stocks" => $stocks, "title" => "Sell a stock"]);
    }
    
    // if user reached page via a POST request
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // validate user input
        if (isset($_POST["stock_to_sell"]))
        {
            // query info about the stock to sell before deleting the corresponding row
            $sell = CS50::query("SELECT symbol,shares FROM portfolios where symbol = ? and user_id = ?", 
            $_POST["stock_to_sell"], $_SESSION["id"]);
            
            $stock = lookup($_POST["stock_to_sell"]);
            $sell["0"]["name"] = $stock["name"];
            $sell["0"]["price"] = $stock["price"];
            
            CS50::query("DELETE FROM portfolios WHERE user_id = ? AND symbol = ?", $_SESSION["id"], $_POST["stock_to_sell"]);
            
            $balance = $sell["0"]["price"] * $sell["0"]["shares"];
            CS50::query("UPDATE users SET cash = cash + ? WHERE id = ?", $balance, $_SESSION["id"]);
            
            $cash = CS50::query("SELECT cash FROM users WHERE id = ?", $_SESSION["id"]);
            $sell["0"]["cash"] = $cash["0"]["cash"];
            
            render("../views/sold.php", ["sell" => $sell, "title" => "Sold {$_POST["stock_to_sell"]} stocks"]);
        }
    }