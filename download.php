<?php
    session_start();
    if (isset($_SESSION['user'])) {
        $sessionUser = $_SESSION['user'];
    } else{
        session_destroy();
        header("Location: /project1");
        exit;
    }

    $config = parse_ini_file("dbinfo.ini");
    $servername = $config["servername"];
    $username = $config["username"];
    $password = $config["password"];
    $dbName = $config["dbName"];
    $tblName = $config["tblName"];
    $tblNameLogin = $config["tblNameLogin"];


    $conn = mysqli_connect($servername, $username, $password, $dbName) or die;
    
    $sqlLogin = "SELECT id, username FROM $tblNameLogin";
    
        $resultLogin = mysqli_query($conn, $sqlLogin) or die;
        if ($resultLogin->num_rows > 0) {
            while($resultID = $resultLogin->fetch_assoc()){
                if($resultID['username'] == $sessionUser){
                    $_SESSION['id'] = $resultID['id'];
                    $sessionUserID = $resultID["id"];
                }
            }
        } else {
            echo "Query failed...";
        }
    
        $sql = "SELECT id, fName, lName, phone, email, address, city, province, postal, dob, UserId FROM $tblName";
        
        $result = mysqli_query($conn, $sql) or die;

        @unlink("save.csv");
        $file = fopen ("save.csv", "w");
        @fwrite($file);
        @fclose($file);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                if($row['UserId'] == $sessionUserID){
                    $input = [$row['id'], $row['fName'], $row['lName'], $row['phone'], $row['email'], $row['address'], $row['city'], $row['province'], $row['postal'], $row['dob'], $row['UserId']];
                    $file = fopen ("save.csv", "a");
                    @fputcsv($file,$input);
                    @fclose($file);
                }
            }
        } else {
            $contact = "0 results";
        }
        
        $conn->close();

        //header("Location: /project1/home.php");
        //exit;

        
        

        