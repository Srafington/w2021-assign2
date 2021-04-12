<?php
    function drawHeader($pageName, $isRoot=false){
        echo '<div id="header">';
        echo "<h1>Logo $pageName</h1>";
        if($isRoot){
            echo "Home button placeholder";
        }
    }