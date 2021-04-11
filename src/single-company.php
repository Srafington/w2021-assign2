<style>
<?php include "index.css"; ?>
</style>
<?php
require_once 'config.inc.php';
require_once 'index-db-classes.inc.php';
try {
    $conn = DatabaseHelper::createConnection(array(DBCONNSTRING,
    DBUSER, DBPASS));
    if (isset($_GET['company'])) {
    $gateway = new CompanyDB($conn);
    $company = $gateway->getAllForCompany($_GET["company"]);
    } else {
    echo "Error";
    }
    } catch (Exception $e) {
    die( $e->getMessage() );
    }

function displayInfo($company){?>
<div class="box">
            <h1>Company Information</h1>
            <section id="info">
                <img id="logo" src="/logos/<?=$company['symbol']; ?>.svg">
                <label>Company Symbol: <span><?=$company['symbol']; ?></span></label>
                <label>Company Name: <span><?=$company["name"]; ?></span></label>
                <label>Sector: <span><?=$company["sector"]; ?></span></label>
                <label>Subindustry: <span><?=$company["subindustry"]; ?></span></label>
                <label>Address: <span><?=$company["address"]; ?></span></label>
                <label>Website: <span><a href='<?=$company["website"];?>'><?=$company["website"]; ?></a></span></label>
                <label>Exchange: <span><?=$company["exchange"]; ?></span></label>
                <label>Description: <span><?= $company["description"]; ?></span></label>
            </section>
            <section id="buttonContainer">
            <form action="favorites.php" method="get">
                <input class="queryString" type="text" name="history" value="<?=$company['symbol'];?>"/> 
                <button class="infoButtons" type="submit" value="favorite"><i class="fas fa-star"></i> Favorites</button>
            </form>
            <form action="history.php?history=<?=$company['symbol']; ?>" method="get">
                <input class="queryString" type="text" name="history" value="<?=$company['symbol'];?>"/> 
                <button class="infoButtons" type="submit" value="history"><i class="fas fa-chart-line"></i> History</button>
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

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
        integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
</head>

<body>
<?php displayInfo($company[0]) ?>
</body>
</html>