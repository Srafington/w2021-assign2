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
echo json_encode($_SESSION);
$userID = $_SESSION['userID'];
$gateway = new PortfolioDB($conn);
$portfolio = $gateway->getPortfolio();

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
                
                ?>
            </ul>
        </fieldset>
        <form action="" method="POST">
            <input type="hidden" name="remove-all" value="" />
            <button class="infoButtons" type="submit" value="remove-all">
                <span class="fa-stack fa-1x">
                    <i class="fas fa-star fa-stack-2x fa-xs"></i>
                    <i id="dark" class="fas fa-times fa-stack-1x fa-sm"></i>
                </span> 
                Remove All</button>
        </form>
    </div>
</body>

</html>