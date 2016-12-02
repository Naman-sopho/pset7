<?php

    // configuration
    require("../includes/config.php");
    
    $rows = CS50::query("SELECT shares,symbol FROM portfolios WHERE user_id = ?", $_SESSION["id"]);
    $balance = CS50::query("SELECT cash FROM users WHERE id = ?", $_SESSION["id"]);
    $tables = [];
    foreach ($rows as $row)
    {
        $stock = lookup($row["symbol"]);
        if ($stock !== false)
        {
            $tables[] = [
                    "name" => $stock["name"],
                    "price" => $stock["price"],
                    "shares" => $row["shares"],
                    "symbol" => $row["symbol"]
                ];
        }
    }
    
    // render portfolio
    render("portfolio.php", ["tables" => $tables, "balance" => $balance, "title" => "Portfolio"]);
?>
