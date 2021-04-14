<?php
require_once 'config.inc.php';
require_once 'index-db-classes.inc.php';
include "header.inc.php";


try {
    $conn = DatabaseHelper::createConnection(array(
        DBCONNSTRING,
        DBUSER, DBPASS
    ));
    if (isset($_GET['company'])) {
        $gateway = new CompanyDB($conn);
        $company = $gateway->getAllForCompany($_GET["company"])[0];
    } else {
        echo "Error";
    }
} catch (Exception $e) {
    die($e->getMessage());
}


$isFav = isset(SessionManager::getFavorites()[$company['symbol']]);

if (isset($_POST['favorite'])) {
    if($isFav){
        SessionManager::removeFavorite($company['symbol']);
    } else {
        SessionManager::addFavorite($company);
        header("Location: /favorites.php");
        die();

    }
    $isFav = !$isFav;
} 

function displayInfo($company, $isFav)
{ ?>
    <div class="prettyBox">
        <section id="info">
            <img id="logo" src="/logos/<?= $company['symbol']; ?>.svg">
            <label>Company Symbol: <span><?= $company['symbol']; ?></span></label>
            <label>Company Name: <span><?= $company["name"]; ?></span></label>
            <label>Sector: <span><?= $company["sector"]; ?></span></label>
            <label>Subindustry: <span><?= $company["subindustry"]; ?></span></label>
            <label>Address: <span><?= $company["address"]; ?></span></label>
            <label>Website: <span><a href='<?= $company["website"]; ?>'><?= $company["website"]; ?></a></span></label>
            <label>Exchange: <span><?= $company["exchange"]; ?></span></label>
            <label>Description: <span><?= $company["description"]; ?></span></label>
        </section>
        <section class="buttonContainer">
            <form action="" method="POST">
                <input type="hidden" name="favorite" value="fav" />
                <button class="infoButtons" type="submit" value="favorite">
                <span class="fa-stack fa-2x">
                    <i class="fas fa-star fa-stack-2x fa-xs"></i>
                        <?php 
                            if($isFav) {
                                echo '<i id="dark" class="fas fa-minus fa-stack-1x fa-xs"></i>';
                            } else {
                                echo '<i id="dark" class="fas fa-plus fa-stack-1x fa-xs"></i>';
                            }
                        ?>
                      </span>
                Favorite</button>
            </form>
            <form action="" method="GET">
                <button class="infoButtons" type="submit" value="history"><i class="fas fa-chart-line"></i><a href='history.php?history=<?= $company['symbol']; ?>'> History</a></button>
            </form>
        </section>
    </div>

<?php
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Company Financials</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <?php 
    drawHeader("Company Information");
    displayInfo($company, $isFav) ?>
</body>

</html>