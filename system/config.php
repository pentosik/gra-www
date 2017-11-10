<?php
    
    //Dane do Polaczenia z baza danych /data to connection to db
    $db_server="localhost";
    $db_username="root";
    $db_password="";
    $db="mmorts";

    //Create connection/Polaczenie z baza danych
    $conn=new mysqli($db_server,$db_username,$db_password,$db);

    //Check connection /sprawdzanie polaczenia
    if($conn->connect_error)
    {
        die("Connection Failed: ".$conn->connect_error);
    }
    else
    {
        //Connection to Database works/ Polaczono z baza danych DODAC SEPARATOR
        $query="SELECT name, description, maintenance, logo FROM configuration";
        $result=mysqli_query($conn,$query);
        $row=mysqli_fetch_assoc($result);

        //$name=$row['name'];
    }



    //General setting/glowne ustawienia
    $title=$row['name'];
    $separator=" - "; //SEPARATOR NIE ZROBIONY DODAC
    $description=$row['description'];
    $logo=$row['logo'];

    //technical Setting/ ustawienia techniczne
    $maintenance=$row['maintenance'];


?>