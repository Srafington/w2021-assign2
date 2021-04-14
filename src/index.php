<?php

include "header.inc.php";

$isLoggedIn = SessionManager::isLoggedIn();

function generateButtons()
{ ?>
    <div class="box a">
        <form action="about.php" method="get">
            <button class="buttonIcons" type="submit" value="about"><i class="far fa-question-circle"></i> About</button>
        </form>
    </div>
    <div class="box b">
        <form action="list.php" method="get">
            <button class="buttonIcons" type="submit" value="list"><i class="fas fa-building"></i> Companies</button>
        </form>
    </div>
    <div class="box c">
        <form action="login.php" method="get">
            <button class="buttonIcons" type="submit" value="login"><i class="fas fa-sign-in-alt"></i> Login</button>
        </form>
    </div>
    <div class="box d">
        <form action="coming-soon.php" method="get">
            <button class="buttonIcons" type="submit" value="signup"><i class="fas fa-user-plus"></i> Sign Up</button>
        </form>
    </div>
<?php
}
function generateAllButtons()
{ ?>
    <div class="box a">
        <form action="about.php" method="get">
            <button class="buttonIcons" type="submit" value="about"><i class="far fa-question-circle"></i> About</button>
        </form>
    </div>
    <div class="box b">
        <form action="list.php" method="get">
            <button class="buttonIcons" type="submit" value="list"><i class="fas fa-building"></i> Companies</button>
        </form>
    </div>
    <div class="box c">
        <form action="coming-soon.php" method="get">
            <button class="buttonIcons" type="submit" value="portfolio"><i class="fas fa-clipboard-list"></i> Portfolio</button>
        </form>
    </div>
    <div class="box d">
        <form action="favorites.php" method="get">
            <button class="buttonIcons" type="submit" value="favorite"><i class="fas fa-star"></i> Favorites</button>
        </form>
    </div>
    <div class="box e">
        <form action="favorites.php" method="get">
            <button class="buttonIcons" type="submit" value="profile"><i class="fas fa-address-card"></i> Profile</button>
        </form>
    </div>
    <div class="box f">
        <form action="login.php" method="get">
            <input type="hidden" name="LOGOUT" value="logout">
            <button class="buttonIcons" type="submit" value="LOGOUT"><i class="fas fa-sign-out-alt"></i> Logout</button>
        </form>
    </div>
<?php
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

    <main class="container">
        <?php 
        drawHeader("Stocks Browser", true); 
        if ($isLoggedIn) {
            generateAllButtons();
        } else {
            generateButtons();
        }
        ?>
    </main>
</body>

</html>