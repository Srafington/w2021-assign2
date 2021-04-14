<?php
require_once 'header.inc.php';
require_once 'index-db-classes.inc.php';

$favs = SessionManager::getFavorites();


if (isset($_POST['remove'])) {
    SessionManager::removeFavorite($_POST['remove']);
    unset($favs);
}
if (isset($_POST['remove-all'])) {
    unset($_SESSION['favorites']);
    unset($favs);
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

    <?php drawHeader("Favorite Companies"); ?>
    <div class="prettyBox">

        <fieldset>
            <ul id="companyList">
                <?php
                if (isset($favs)) {
                    foreach ($favs as $symbol => $details) {
                        echo '<form action="" method="POST">';
                        echo "<li> <a href='/single-company.php?symbol=$symbol'>";
                        echo '<img class="smallLogo" src="/logos/' . $symbol . '.svg" alt="' . $symbol . '">';
                        echo "<span class='list-span'>$symbol</span><span class='list-span'>  " . $details['name'] . "</span></a>";
                        echo '<input type="hidden" name="remove" value="' . $symbol . '" />';
                        echo '<button class="infoButtons" type="submit" value="' . $symbol . '">';
                        echo '<span class="fa-stack fa-1x">';
                        echo '<i class="fas fa-star fa-stack-2x fa-xs"></i>';
                        echo '<i id="dark" class="fas fa-minus fa-stack-1x fa-xs"></i>';
                        echo '</span>';
                        echo "Remove</button>";
                        echo "</li>";
                        echo "</form>";
                    }
                } else {
                    echo "<li>No Favorites saved!</i>";
                }
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