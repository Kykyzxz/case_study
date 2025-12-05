<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "case_study";


    // creating a connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    if($conn -> connect_error){
        echo "Connection Failed!";
    }
    
?>