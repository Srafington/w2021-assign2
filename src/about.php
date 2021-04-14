<?php
require_once 'styles.php';
include "header.inc.php";

function generateDisplay()
{ ?>
    <main class="prettyBox csBox with-backgound" id="aboutBox">
        <div id="aboutBlock">
            <div>
                <h2>About The Website</h2>
                <p>Our website provides users with the ability to view the basic information of various well known companies. In addition we have features that
                    will also display recent stock data for the respective chosen company. Our website also provides members with additional features such as the ability to track and view
                    companies that have added to their favorites list.
                </p>
                <h2>About Us</h2>
                <p>This website was created by Jon Axford and Latonia To as a project for our web development course. We applied skills and knowledge gained from Mount Royal University's COMP 3512.
                    PHP, HTML, CSS, JavaScript, Docker and MySQL were used to create this website and Heroku to host it.
                </p>
            </div>
        </div>
    </main>
<?php

}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Company Financials</title>
    <link rel="stylesheet" href="styles.css">
    <?php randBackground(); ?>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
</head>

<body>
    <?php
    drawHeader("Stocks Browser");
    generateDisplay()
    ?>
</body>

</html>