
<html>
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="github-markdown.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


</head>

<body class=container>    
<div  class="markdown-body">
    <p>
        <a href="./.">get back to Parking</a>
    </p>
    <?php 
    if(isset($_GET["f"]) && $_GET["f"] != ""){
        if(is_file($_GET["f"])){
            include $_GET["f"];
        }else{
            echo "not a file";
        }
    }else{
        echo "<p style=text-align:center;> 
                let's go back to Parking! 
             </p>";
    } 
    ?>
</div>
</body>
</html>

