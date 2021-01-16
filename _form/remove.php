<h3>
<?php

if(isset($_GET['rm']) && is_file($_GET['rm']) ){
    $file = $_GET['rm'];
    
    if(unlink($file)) {
        $str = "<span class='text-success'>"
        . "success. </span> ";
        echo $str;
    }else{
        $str = "<span class='text-danger'>"
        . "failure. </span>  ";
        echo $str;
    }

    
    echo ": removal of \"" . $file . "\"<br>";
}
?>
</h3>