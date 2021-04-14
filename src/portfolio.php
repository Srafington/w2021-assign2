<?php
require_once 'config.inc.php';
require_once 'header.inc.php';
require_once 'index-db-classes.inc.php';

if (!SessionManager::isLoggedIn()) {
    header("Location: /");
    die();
}
$conn = DatabaseHelper::createConnection(array(
    DBCONNSTRING,
    DBUSER, DBPASS
));
$userID = $_SESSION['userID'];
$gateway = new PortfolioDB($conn);
$portfolio = $gateway->getPortfolio();
$totalValue = 0.0;

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

    <?php drawHeader("Your Portfolio"); ?>
    <div class="prettyBox">

        <fieldset>
            <ul id="companyList">

                <table id='stock'>
                    <tr id='stockHeaders portfolio-head'>
                        <th></th>
                        <th>Symbol</th>
                        <th>Name</th>
                        <th>Amount</th>
                        <th>$ Close</th>
                        <th>$ Value</th>
                    </tr>
                        <?php
                        foreach ($portfolio as $row) {
                            echo "<tr class='portfolio-row'> ";
                            echo '<td>' . "<a href='/single-company.php?company=" . $row['symbol'] . "'>" . '<img class="smallLogo" src="/logos/' . $row['symbol'] . '.svg" alt="' . $row['symbol'] . '"></a></td>';
                            echo '<td>' . "<a href='/single-company.php?company=" . $row['symbol'] . "'>" . $row['symbol'] . '</a></td>';
                            echo '<td>' . "<a href='/single-company.php?company=" . $row['symbol'] . "'>" . $row['name'] . '</a></td>';
                            echo '<td>' . number_format($row['amount'], 0, '.') . '</td>';
                            echo '<td>$' . number_format($row['close'], 2, '.') . '</td>';
                            echo '<td>$' . number_format($row['total_value'], 2, '.') . '</td>';
                            echo "</tr>";
                            $totalValue = $totalValue + $row['total_value'];
                        }
                        ?>
                </table>
            </ul>
        </fieldset>
           <div id="total-line"> <div class="totals">Total Portfolio Value $<?php echo number_format($totalValue, 2, '.'); ?></div></div>
    </div>
    </div>
</body>

</html>