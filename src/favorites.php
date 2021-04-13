<?php
require_once 'config.inc.php';
require_once 'index-db-classes.inc.php';
require_once 'index-db-classes.inc.php';
require_once 'header.inc.php';
try {
    $conn = DatabaseHelper::createConnection(array(
        DBCONNSTRING,
        DBUSER, DBPASS
    ));
    if (isset($_GET['history'])) {
        $symbol = $_GET["history"];
        SessionManager::upsertSessionVar('symbol', $symbol);
        $gateway = new HistoryDB($conn);
        $history = $gateway->getAllForHistory($symbol);
    } else if (isset($_GET['sort'])) {
        $gateway = new HistoryDB($conn);
        $symbol = SessionManager::getSessionVar('symbol');
        $history = $gateway->getSortedAllForHistory($symbol, $_GET["sort"]);
    } else {
        echo "Error";
    }
} catch (Exception $e) {
    die($e->getMessage());
}

function displayHistory($history)
{
    echo "<h1>Company Stock Data</h1>";
    echo "<img id='historyLogo' src='/logos/" . SessionManager::getSessionVar('symbol') . ".svg'>";
    echo "<form action='history.php' method='get'>";
    echo "<div id='table'>";
    echo "<table id='stock'>";
    echo "<tr id='stockHeaders'>";
    echo "<th><a href=''>Date</a></th>";
    echo "<th><a href='?sort=volume'>Volume</a></th>";;
    echo "<th>Open</th>";
    echo "<th>Close</th>";
    echo "<th>High</th>";
    echo "<th>Low</th>";
    echo "</tr>";
    foreach ($history as $key => $value) { ?>
        <tr>
            <td><?= $value['date']; ?></td>
            <td><?= $value['volume']; ?></td>
            <td><?= $value['open']; ?></td>
            <td><?= $value['close']; ?></td>
            <td><?= $value['high']; ?></td>
            <td><?= $value['low']; ?></td>
        </tr>
<?php
    }
    echo "</table>";
    echo "</div>";
}
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Your Favorites</title>

    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
</head>

<body>
    <?php displayHistory($history) ?>
</body>

</html>