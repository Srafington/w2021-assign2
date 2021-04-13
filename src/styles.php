<?php   
    function randBackground(){
        echo '<style>.csBox { background-image: url("/images/bg'. rand ( 1 , 3 ) .'.jpg");}</style>';
    }
?>