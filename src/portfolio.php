<?php
require_once 'config.inc.php';
require_once 'header.inc.php';
require_once 'index-db-classes.inc.php';

if(!SessionManager::isLoggedIn()){
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
                <?php
                foreach ($portfolio as $symbol => $details) {
                    echo '<form action="" method="POST">';
                    echo "<li> <a href='/single-company.php?symbol=$symbol'>";
                    echo '<img class="smallLogo" src="/logos/' . $symbol . '.svg" alt="' . $symbol . '">';
                    echo '<span>' . $details['name'] . '</span>';
                    echo '<span>' . $details['amount'] . '</span>';
                    echo '<span>' . $details['close'] . '</span>';
                    echo '<span>' . $details['total_value'] . '</span>';
                    echo "</li>";
                    echo "</form>";
                ?>
            </ul>
        </fieldset>
        <div>
            <span>Total Portfolio Value <?php $totalValue?></span>
        </div>
    </div>
</body>

</html>