<?php
    echo "<h1>Insert genre</h1>";

    require_once('functions.php');
	 
	 

    // Test of er op de insert-knop is gedrukt 
    if(isset($_POST) && isset($_POST['btn_ins'])){
		 
        Insertgenre($_POST);
        echo '<script>alert("genrenaam: ' . $_POST['genrenaam'] . ' is toegevoegd")</script>';
    }
?>

<html>
    <body>
        <form method="post">
        <br>
        genre naam:<input type="" name="genrenaam"><br> 
        Genre ID: <input type="text" name="genreid"><br>      
        <br>
        <input type="submit" name="btn_ins" value="Insert"><br>
        </form>
        <br><br>
        <a href='crud_genre.php'>Home</a>
    </body>
</html>