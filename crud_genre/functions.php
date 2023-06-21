<?php
// auteur: Dylan
// functie: algemene functies tbv hergebruik
 function ConnectDb(){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "3dplus";
   
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        //echo "Connected successfully";
        return $conn;
    } 
    catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

 }

 
 // selecteer de data uit de opgeven table
 function GetData($table){
    // Connect database
    $conn = ConnectDb();

    // Select data uit de opgegeven table methode query
    // query: is een prepare en execute in 1 zonder placeholders
    // $result = $conn->query("SELECT * FROM $table")->fetchAll();

    // Select data uit de opgegeven table methode prepare
    $query = $conn->prepare("SELECT * FROM $table");
    $query->execute();
    $result = $query->fetchAll();

    return $result;
 }

 // selecteer de rij van de opgeven genreid uit de table genre
 function Getgenre($genreid){
    // Connect database
    $conn = ConnectDb();

    // Select data uit de opgegeven table methode prepare
    
    $query = $conn->prepare("SELECT * FROM genre WHERE genreid = :genreid");
    $query->execute([':genreid'=>$genreid]);
    $result = $query->fetch();

    return $result;
 }


 function Ovzgenre(){

    // Haal alle genre record uit de tabel 
    $result = GetData("genre");
    
    //print table
    PrintTable($result);
    //PrintTableTest($result);
    
 }

 
// Function 'PrintTable' print een HTML-table met data uit $result.
function PrintTable($result){
    // Zet de hele table in een variable en print hem 1 keer 
    $table = "<table border = 1px>";

    // Print header table

    // haal de kolommen uit de eerste [0] van het array $result mbv array_keys
    $headers = array_keys($result[0]);
    $table .= "<tr>";
    foreach($headers as $header){
        $table .= "<th bgcolor=gray>" . $header . "</th>";   
    }

    // print elke rij
    foreach ($result as $row) {
        
        $table .= "<tr>";
        // print elke kolom
        foreach ($row as $cell) {
            $table .= "<td>" . $cell . "</td>";
        }
        $table .= "</tr>";
    }
    $table.= "</table>";

    echo $table;
}


function Crudgenre(){

    // Menu-item   insert
    $txt = "
    <h1>Crud genre</h1>
    <nav>
		<a href='insert_genre.php'>Toevoegen nieuw genre</a>
    </nav>";
    echo $txt;

    // Haal alle genre record uit de tabel 
    $result = GetData("genre");

    //print table
    PrintCrudgenre($result);
    
 }
 // Function 'PrintCrudgenre' print een HTML-table met data uit $result 
 // en een wzg- en -verwijder-knop.
function PrintCrudgenre($result){
    // Zet de hele table in een variable en print hem 1 keer 
    $table = "<table border = 1px>";

    // Print header table

    // haal de kolommen uit de eerste [0] van het array $result mbv array_keys
    $headers = array_keys($result[0]);
    $table .= "<tr>";
    foreach($headers as $header){
        $table .= "<th bgcolor=gray>" . $header . "</th>";   
    }
    $table .= "</tr>";

    // print elke rij
    foreach ($result as $row) {
        
        $table .= "<tr>";
        // print elke kolom
        foreach ($row as $cell) {
            $table .= "<td>" . $cell . "</td>";
            
        }
        
        // Wijzig knopje
    $table .= "<td>". 
        "<form method='post' action='update_genre.php?genreid=$row[genreid]' >       
            <button name='wzg'>Wzg</button>	 
        </form>" . "</td>";

        // Delete via linkje href
        $table .= '<td><a href="delete_genre.php?genreid='.$row["genreid"].'">verwijder</a></td>';
        
        $table .= "</tr>";
    }
    $table.= "</table>";

    echo $table;
}


function Updategenre($row){
       
    try{
        // Connect database
        $conn = ConnectDb();
        
        // Update data uit de opgegeven table methode prepare
        $sql = "UPDATE genre
        SET 
            genrenaam = '$row[genrenaam]'
        WHERE genreid = $row[genreid]";
        
        $query = $conn->prepare($sql);
        $query->execute();
        
    }

    catch(PDOException $e) {
        echo "Update failed: " . $e->getMessage();
    }
}

function Insertgenre($post){
    try {
        $conn = ConnectDb();

        // Get the maximum genre ID from the database
        $query = $conn->prepare("SELECT MAX(genreid) as max_genreid FROM genre");
        $query->execute();
        $result = $query->fetch();
        $maxGenreID = $result['max_genreid'];

        // Increment the maximum genre ID by 1 to get the new ID
        $newGenreID = $maxGenreID + 1;

        $query = $conn->prepare("
        INSERT INTO genre (genreid, genrenaam) 
        VALUES (:genreid, :genrenaam)");

        // Bind the genre ID and genre name to the query parameters
        $query->bindParam(':genreid', $newGenreID);
        $query->bindParam(':genrenaam', $post['genrenaam']);

        $query->execute();
        echo '<script>alert("genrenaam: ' . $post['genrenaam'] . ' is toegevoegd")</script>';
    } catch(PDOException $e) {
        echo "Insert failed: " . $e->getMessage();
    }
}


function Deletegenre($genreid){
    echo "Delete row<br>";
    try{
        // Connect database
        $conn = ConnectDb();
        
        // Update data uit de opgegeven table methode prepare
        $sql = "DELETE FROM genre
                WHERE genreid = '$genreid'";
                
        $query = $conn->prepare($sql);
        $result = $query->execute();

    }

    catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();

    }
}


?>