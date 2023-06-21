<?php
echo "<h1>Update genre</h1>";
require_once('functions.php');

if(isset($_POST) && isset($_POST['btn_wzg'])){
   Updategenre($_POST);
}

    if(isset($_GET['genreid'])){
        

        echo "Data uit het vorige formulier:<br>";
        // Haal alle info van de betreffende genreid $_GET['genreid']
        $genreid = $_GET['genreid'];
        $row = Getgenre($genreid);
    }
   ?>

<html>
    <body>
        <form method="post">
        <input type="hidden" name="genreid" value="<?php echo $row['genreid'];?>"><br>
        genre naam:<input type="" name="genrenaam" value="<?php echo $row['genrenaam'];?>"><br> 
        Genre ID: <input type="text" name="genreid" value="<?= $row['genreid']?>"><br><br>
       
        <br><br>
        <input type="submit" name="btn_wzg" value="Wijzigen"><br>
        </form>
        <br><br>
        <a href='crud_genre.php'>Home</a>
        </body>
        </html>