<form action="sell.php" method="POST">
    <h4>Select the stock you wish to sell.</h4><br>
    <?php foreach($stocks as $stock): ?>
        <input type="radio" name="stock_to_sell" unchecked value="<?= $stock["symbol"]?>">
            &nbsp;<?= $stock["name"] ?> (<?= ($stock["symbol"])?>) &nbsp; 
            [Current Price : $<?= number_format($stock["price"], 2) ?>, Shares Owned : <?= $stock["shares"] ?>]
            <br>
        </input>
        <br>
    <?php endforeach ?>
        <div class="form-group">
            <button class="btn btn-default" type="submit">
                <span aria-hidden="true" class="glyphicon glyphicon-log-in"></span>
                Sell
            </button>
        </div>
    
</form>