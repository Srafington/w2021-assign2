<?php
    function drawHeader($pageName, $isRoot=false){
        //echo '<div id="header">';
        echo '<div class="h" id="icons">
        <div>
            <i id="Credit" class="fas fa-chart-bar"></i>
        </div>';
        echo "<h1>$pageName</h1>";
        echo '<div>
            <i id="Credit" class="fa fa-bars"></i>
        </div>
        </div>';
        if($isRoot){
            echo "Home button placeholder";
        }
    }