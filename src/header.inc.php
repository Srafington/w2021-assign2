<?php
    function drawHeader($pageName, $isRoot=false){
        //echo '<div id="header">';
        echo '<div class="h" id="icons">
        <div>
        <a href="/" title="Home"><i class="fas fa-home credit"></i></a>
        </div>';
        echo "<h1>$pageName</h1>";
        echo '<div>
            <i class="fa fa-bars credit"></i>
        </div>
        </div>';
        if($isRoot){
            echo "Home button placeholder";
        }
    }