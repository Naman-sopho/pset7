<h3>Successfully sold <?= $sell["0"]["shares"] ?> shares of (<?= $sell["0"]["name"] ?>)(<?= $sell["0"]["symbol"] ?>).</h3><br>
<h3>You got $<?= number_format($sell["0"]["price"] * $sell["0"]["shares"], 2) ?> from the above transaction.</h3><br>
<h4>Your Current Balance is</h4><h4 style="font-weight:bold;">$<?= number_format($sell["0"]["cash"], 2)?></h4>