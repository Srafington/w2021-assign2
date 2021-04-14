<?php   
    function randBackground(){
        echo '<style>.prettyBox { background-image: url("/images/bg'. rand ( 1 , 3 ) .'.jpg");}</style>';
    }
?>