<?php
require_once 'header.inc.php';
require_once 'index-db-classes.inc.php';

$favs = SessionManager::getFavorites();

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Company Financials</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
</head>

<body>

    <div>
        <?php drawHeader("Favorite Companies"); ?>
        <form class=textbox action="" method="POST">
            <fieldset>
                <ul id="companyList">
                    <?php
                    if(isset($favs)){
                        foreach ($favs as $symbol=>$details) {
                            echo "<li> ";
                            echo '<img class="smallLogo" src="/logos/' .$details['symbol'] . '.svg" alt="' . $details['symbol'] . '">';
                            echo $details['symbol'] . " " . $details['name']; 
                            echo '<button class="infoButtons" type="submit" value="' . $details['symbol'] . '">';
                            echo '<span class="fa-stack fa-2x">';
                            echo '<i class="fas fa-star fa-stack-2x fa-xs"></i>';
                            echo '<i id="dark" class="fas fa-minus fa-stack-1x fa-xs"></i>';
                            echo '</span>';
                            echo "Remove</button>";
                            echo"</li>";
                        }
                    } else {
                        echo "<li>No Favorites saved!</i>";
                    }
                    ?>
                </ul>
            </fieldset>
        </form>
    </div>
</body>

</html>