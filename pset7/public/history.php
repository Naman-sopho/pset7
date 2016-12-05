<?php

    // configuration
    require("../includes/config.php");
    
    // querying database for user's history
    $transactions = CS50::query("SELECT * FROM history WHERE user_id = ?", $_SESSION["id"]);
    
    $history = [];
    foreach($transactions as $transaction)
    {
        // check if user bought or sold stocks
        if ($transaction["b_or_s"] > 0)
        {
            $type = "Sold";
            $amount = number_format($transaction["b_or_s"] / $transaction["shares"], 2);
        }
                    
        else if ($transaction["b_or_s"] < 0)
        {
            $type = "Bought";
            $amount = -number_format($transaction["b_or_s"] / $transaction["shares"], 2);
        }
        
        $stock = lookup($transaction["symbol"]);
        if ($stock !== false )
        {
            $history[] = [
                
                    "name" => $stock["name"],
                    "symbol" => $stock["symbol"],
                    "current_price" => number_format($stock["price"], 2),
                    "shares" => $transaction["shares"],
                    "timestamp" => $transaction["timestamp"],
                    "type" => $type,
                    "amount" => $amount
                    
                ];
        }
    }

    // render history_view
    render("../views/history_view.php", ["title" => "History", "HISTORY" => $history]);
?>