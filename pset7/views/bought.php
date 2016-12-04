<h3>Successfully bought <?= $buy["shares"] ?> shares of <?= $buy["name"] ?> (<?= $buy["symbol"] ?>).</h3><br>
<h3>You spent $<?= $buy["spent"] ?> in the above transaction.</h3><br>
<h4>Your Current Balance is</h4><h4 style="font-weight:bold;">$<?= number_format($buy["cash"], 2)?></h4>