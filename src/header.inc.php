<?php
require_once 'index-db-classes.inc.php';

function drawHeader($pageName, $isRoot = false)
{
    //echo '<div id="header">';
    echo '<div class="h" id="icons">';
    if (!$isRoot) {
        echo '<div>
        <a href="/" title="Home"><i class="fas fa-home credit"></i></a>
        </div>';
    } else {
        echo "<div>&nbsp;&nbsp;&nbsp;&nbsp;</div>";
    }
    echo "<h1>$pageName</h1>";
    echo '<div class="menu">
        <button class="menu-button">
            <i class="fa fa-bars credit"></i>
        </button>
        <div class="menu-content">
          <a href="/" class="top">Home</a>
          <a href="/about.php">About</a>
          <a href="/list.php">Companies</a>';
    if (isset($_SESSION['user'])) {
        echo '<a href="/coming-soon.php">Portfolio</a>
            <a href="/coming-soon.php">Profile</a>
            <a href="/favorites.php">Favorites</a>
            <a href="/login.php?LOGOUT">Log Out</a>';
    } else {
        echo '<a href="/login.php" class="bottom">Log In</a>';
    }

    echo '</div>
      </div>
    </div>';
}
