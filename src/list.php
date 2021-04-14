<?php

include "header.inc.php";

function generateList(){ ?>
        <div class="prettyBox">
                <form class=textbox action="single-company.php" method="get">
                    <fieldset>
                        <input type="text" class="search" placeholder="Type for matching company"
                        title="filter"><button type="reset" class="filterButton" id="clearButton"><i class="fas fa-undo"></i></button>
                            <div id="loading">
                                <i class="fas fa-10x fa-spinner fa-pulse"></i>
                            </div>
                        <ul id="companyList"></ul>
                    </fieldset>
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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
        integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
</head>

<body>
<?php 
drawHeader("List of Companies");
generateList(); 
?>
<script src="list.js"></script>
<div id="zoomLogo"></div>
</body>
</html>
