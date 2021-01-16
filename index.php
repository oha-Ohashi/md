<?php 
    $root = $_SERVER['DOCUMENT_ROOT'];
    $dir = __DIR__;
    $f_types = ["*.html", "*.md", "*.png", "*.jpg"];        //what kind of files to list up
?>

<html>
<head>
    <title>Markdown Parking</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="かんたんにアップロード、リンクを取得できます。セキュリティはゼロ。">
    <meta property="og:title" content="Markdown Parking">
    <meta property="og:description" content="かんたんにアップロード、リンクを取得できます。セキュリティはゼロ。">
    <meta property="og:url" content="https://ketcha.xyz/pr/md/">
    <meta property="og:image" content="https://ketcha.xyz/pr/md/bela_totte/1/watermark.jp">
    <meta property="og:type" content="article">
    <meta property="og:locale" content="ja_JP">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="oha_oha_Ohashi">

    <!--bootstrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!--Ubuntu-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">

    <style>
        body{
            text-align: center;
            font-family: 'Ubuntu', sans-serif;
        }
        .fname_box{
            display: inline-block;
            text-align: left;
            padding: 20px 40px;
            margin:10px;
            border-radius: 5px;
            background-color: #88888833;
        }
    </style>
</head>

<body class=container-fluid>    
<header>
    <h2>
        Markdown Parking
    </h2>
</header>
<br>
<!----------------------------------------------------------->
<?php require "_form/upload.php"; ?>
<?php require "_form/remove.php";?>

<div  class="markdown-body">
    <?php 
        //pickup directory names. [`*/`, `*/*/`, `*/*/*/`] enough I guess.
        $dirnames = array_merge(
            glob("*/"),
            glob("*/*/"),
            glob("*/*/*/")
        );
        //remove a dir name if it includes no Markdown file.
        $dirnames = array_filter($dirnames, function($dir){
            $n = 0;
            global $f_types;
            foreach($f_types as $ftp){
                $n += count( glob($dir . $ftp));
            }
            //echo "<br>directory `".$dir ."` has (" . $n_html . ") `.html` s." ;
            $privacy = preg_match('/^private/',  $dir);
            //if($privacy){ echo "prpr"; }  else{ echo "pub"; };
            return !$privacy && ($n > 0);
        });
        //debug
        echo "<h2>Documents</H2>";
        foreach($dirnames as $n){
            fname_box($n, "doc");
        }
        echo "<br> ";
        echo "<h2>Raw</H2>";
        foreach($dirnames as $n){
            fname_box($n, "raw");
        }
        echo "<br>";
         
    ?>
    <br><br>_
</div>          <!-- bootstrap container-->


</body>
</html>

<?php
//show file name box to user
function fname_box($dir_name, $docraw){
    global $f_types;
    $ext_doc = ["html", "md"];        //
    $ext_img = ["png", "jpg", "jpeg"];        //
    echo "<span class='fname_box'>";
    echo "<strong>". $dir_name . "</strong><br>";           //show dir name.
    
    foreach($f_types as $type){
        $files = glob($dir_name . $type);               // glob("hoge/*.html")
        if(count($files) > 0) { echo  $type . ": <br>"; };
        foreach(glob($dir_name . $type) as $file){      //glob(hoge/*.md) returns file names.
            if(is_file($file)){
                if($docraw == "doc"){
                    if(in_array( pathinfo($file)['extension'], $ext_doc ) ){
                        a_echo($file, "mdcase");
                    }
                }else if($docraw == "raw"){
                    if(in_array( pathinfo($file)['extension'], $ext_doc ) ){
                        a_echo($file, "rawdoc");
                    }
                    if(in_array( pathinfo($file)['extension'], $ext_img ) ){
                        a_echo($file, "img");
                    }
                }
            }
        }
    }
    echo "<br>";
    echo "</span>";
}
function ismd($arg){
    if(preg_match('/.md$/' , $arg)){
        return "1";
    }else{
        return "0";
    }
}
function a_echo($file, $mode){
    if($mode == "mdcase"){
        echo "<li><a href='";
        echo  "./mdcase.php?";          //href="./mdcase.php?f=hoge/moge.md&md=1" 
        echo  "f=" . $file . "'>";             //?f= :  file name
        echo  basename($file) . "<br>";
        echo "</a></li>";
    }
    else if($mode == "rawdoc"){
        $str = "<li>"
        ."<a href='" . $file . "'>"             //?f= :  file name
        . basename($file) 
        . "</a>"
        . "&ensp;"
        . "<a href= './.?rm="
        . $file
        . " ' >"
        . "remove"
        . "</a>"
        ."</li>";
        echo $str;
    }
    else if($mode == "img"){
        $str = "<img src=" . $file . " alt='image'"
        . " height=50></img>"
        . "<li>"
        . "<a href='" . $file . "'>"
        . basename($file)  // ."<br>" . $file;
        . "</a>"
        . "&emsp;"
        . "<a href= './.?rm="
        . $file
        . " ' >"
        . "remove"
        . "</a>"
        . "</li>";
        echo $str;
    }
}
?>
