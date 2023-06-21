<?php

    echo "<h1>Update genre</h1>";
    require_once('functions.php');

    // Test of er op de wijzig-knop is gedrukt 
    if(isset($_POST['btn_wzg'])){
        Updategenre($_POST);

        //header("location: crud_genre.php");
    }

    if(isset($_GET['genreid'])){  
        // Haal alle info van de betreffende genreid $_GET['genreid']
        $genreid = $_GET['genreid'];
        $row = Getgenre($genreid);
    
?>

<html>
    <body>
        <form method="post">
        <br>
        <input type="hidden" name="genreid" value="<?php echo $row['genreid'];?>"><br>
        Naam:<input type="text" name="genrenaam" value="<?php echo $row['genrenaam'];?>"><br> 
        <input type="submit" name="btn_wzg" value="Wijzigen"><br>
        </form>
        <form method="post" action="crud_genre.php">
    <input type="submit" name="home" value="Home"><br>
</form>

    </body>
</html>

<?php
    } else {
        "Geen genreid opgegeven<br>";
    }
?>