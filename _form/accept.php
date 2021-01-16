<?php 
    $root = $_SERVER['DOCUMENT_ROOT'];
?>


<?php
if(isset($_POST["fold"])) {
    $fold = $_POST["fold"];
    echo $fold . "<br>";
    move_it($fold) ;
}else{
    echo "folder not selected. <br>";
}
$tempfile = $_FILES['fname']['tmp_name'];
$filename = './' . $_FILES['fname']['name'];
 
function move_it($fold){
    echo $fold . "mvi<br>";
    $tempfile = $_FILES['fname']['tmp_name'];
    $filename = '../bela_totte/' . $fold . $_FILES['fname']['name'];

    if (is_uploaded_file($tempfile)) {
        if ( move_uploaded_file($tempfile , $filename )) {
            echo $filename . "をアップロードしました。";
            echo "<h2><a href='../'>Get Back to Parking</a></h2>";
        } else {
            echo "ファイルをアップロードできません。";
        }
    } else {
        echo "ファイルが選択されていません。";
    } 
}
?>