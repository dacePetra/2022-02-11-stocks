<?php

require_once(__DIR__ . '/vendor/autoload.php');
//echo "<pre>";
$config = Finnhub\Configuration::getDefaultConfiguration()->setApiKey('token', 'sandbox_c82nhfaad3ia125986dg');
$client = new Finnhub\Api\DefaultApi(
    new GuzzleHttp\Client(),
    $config
);
$search = $_GET['search'] ?? 0;
$myStocks = ["NFLX", "ASML", "MRVL", "PYPL"];
function color($change){
    if($change>=0){
        return "<span style='color:darkgreen'>{$change}%</span>";
    }else{
        return "<span style='color:red'>{$change}%</span>";
    }
}
?>
<head>
    <title>STOCKS</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h1>Stock API - Basic 1</h1>
<div class="search">
    <form method="get" action="/">
        <label for="site-search">Enter stock symbol:</label><br>
        <input name="search"/><br>
        <button type="submit">Submit</button>
    </form>
</div>
<div class="box-wrapper">
    <?php if (isset($search) && count($search) === 4 || ctype_alpha($search)) {
        $search = strtoupper($search);
        $change = "" . number_format($client->quote($search)["dp"], 2); ?>
        <div class="box"> <?php echo $search . "<br>" . "$" . $client->quote($search)["c"] . "<br>";
        echo color($change) ?> </div>
    <?php } else {
        foreach ($myStocks as $stock) {
        $change = "" . number_format($client->quote($stock)["dp"], 2); ?>
        <div class="box"> <?php echo $stock . "<br>" . "$" . $client->quote($stock)["c"] . "<br>";
        echo color($change) ?> </div>
        <?php }} ?>
</div>
</body>




