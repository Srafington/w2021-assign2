<style>
<?php include "index.css"; ?>
</style>
<?php

function generateList(){ ?>
        <div>
                <h1>List of Companies</h1>
                <form class=textbox action="single-company.php" method="get">
                    <fieldset>
                        <input type="text" class="search" placeholder="Type for matching company"
                        title="filter"><button type="submit" class="filterButton" id="submitButton"><i class="fas fa-check-square"></i></button>
                        <button type="reset" class="filterButton" id="clearButton"><i
                            class="fas fa-undo"></i></button>
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

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
        integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
</head>

<body>
<?php generateList(); ?>
<script src="list.js"></script>
<div id="zoomLogo"></div>
</body>
</html>
