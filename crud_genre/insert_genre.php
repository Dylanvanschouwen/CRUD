<?php
    echo "<h1>Insert genre</h1>";

    require_once('functions.php');

    if(isset($_POST) && isset($_POST['btn_ins'])){
        Insertgenre($_POST);
    }
?>

<html>
    <body>
        <form method="post">
        <br>
        genrenaam:<input type="text" name="genrenaam"><br> 
        <br>
        <input type="submit" name="btn_ins" value="Insert"><br>
        </form>
        <br><br>
        <a href='crud_genre.php'>Home</a>
    </body>
</html>
