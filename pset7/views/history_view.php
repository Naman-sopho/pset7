<table>
    <tr>
        <th>Stock Name</th>
        <th>Stock Symbol</th>
        <th>Shares</th>
        <th>Stocks Bought or Sold</th>
        <th>Time</th>
        <th>Current Price</th>
        <th>Price At transaction</th>
    </tr>

<?php foreach ($HISTORY as $history): ?>
        
    <tr>
        <td><?= $history["name"] ?></td>
        <td><?= $history["symbol"] ?></td>
        <td><?= $history["shares"] ?></td>
        <td><?= $history["type"]?></td>
        <td><?= $history["timestamp"]?></td>
        <td>$<?= $history["current_price"] ?></td>
        <td>$<?= $history["amount"]?></td>
    </tr>

<?php endforeach ?>

</table>