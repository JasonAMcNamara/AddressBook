<?php 
    session_start();
    if (isset($_SESSION['user'])) {
        $sessionUser = $_SESSION['user'];
    } else{
        session_destroy();
        header("Location: /project1");
        exit;
    }
    $subject = $_GET['subject'];
    $message = $_GET['message'];
    $config = parse_ini_file("dbinfo.ini");
    $servername = $config["servername"];
    $username = $config["username"];
    $password = $config["password"];
    $dbName = $config["dbName"];
    $tblName = $config["tblName"];
    $tblNameLogin = $config["tblNameLogin"];
    
    $mailheaders = "From: webmaster@nscctruro.ca"."\r\n";

    $contact = "";

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

    $sql = "SELECT id,fName, lName, phone, email, address, city, province, postal, dob, UserId FROM $tblName";
    
    $result = mysqli_query($conn, $sql) or die;
    
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if($row['UserId'] == $sessionUserID){
                mail($row['email'],$subject,$message, $mailheader);
            }
        }
    } else {
        $contact = "0 results";
    }

    $conn->close();
    header("Location: /project1/home.php");
    exit;

?>