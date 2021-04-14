<?php
require_once 'config.inc.php';
require_once 'index-db-classes.inc.php';
include "header.inc.php";
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
    echo '<div class="prettyBox">';
    echo "<img id='historyLogo' src='/logos/" . SessionManager::getSessionVar('symbol') . ".svg'>";
    echo "<div id='table'>";
    echo "<table id='stock'>";
    echo "<tr id='stockHeaders'>";
    echo "<th><a href='?history=" . SessionManager::getSessionVar('symbol') . "'>Date</a></th>";
    echo "<th><a href='?sort=volume'>Volume</a></th>";;
    echo "<th><a href='?sort=open'>Open</a></th>";
    echo "<th><a href='?sort=close'>Close</a></th>";
    echo "<th><a href='?sort=high'>High</a></th>";
    echo "<th><a href='?sort=low'>Low</a></th>";
    echo "</tr>";
    foreach ($history as $key => $value) { ?>
        <tr>
            <td><?= date("Y - M - d", strtotime($value['date'])); ?></td>
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
    echo "</div>";
}
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Company Financials</title>

    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
</head>

<body>
    <?php 
    drawHeader("Company Stock Data");
    displayHistory($history) 
    ?>
</body>

</html>