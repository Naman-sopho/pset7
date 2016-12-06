<?php if (!empty($tables)): ?>
    <table>
        <tr>
            <th>Stock Name</th>
            <th>Stock Symbol</th>
            <th>Shares Owned</th>
            <th>Current Price</th>
            <th>Current Value</th>
        </tr>
    
        <?php foreach ($tables as $table): ?>
                
            <tr>
                <td><?= $table["name"] ?></td>
                <td><?= $table["symbol"] ?></td>
                <td><?= $table["shares"] ?></td>
                <td>$<?= number_format($table["price"],$decimal = 2) ?></td>
                <td>$<?= $current_value = number_format($table["shares"] * $table["price"],$decimal = 2)  ?></td>
            </tr>
        
        <?php endforeach ?>
    
    </table>
    <br>
<?php else: ?>
    <h4>Your own <b>no</b> stocks at the moment!</h4><br>
<?php endif ?>

<h4>Your Current Balance is</h4><h4 style="font-weight:bold;">$<?= number_format($balance["0"]["cash"],$decimal = 2)?></h4><br><br>
<h5>Click <a href="change_password.php">here</a> to change your password.</h5>