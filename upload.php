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
    $stmt = $conn->prepare("INSERT INTO $tblName (fName, lName, phone, email, address, city, province, postal, dob, UserId) VALUES (?,?,?,?,?,?,?,?,?,?)");
    $stmt->bind_param("sssssssssi", $fName, $lName, $phone, $email, $address, $city, $province, $postal, $dob, $id);

    if(isset($_POST['upload'])){
        $file = $_FILES['file']["tmp_name"];
        $file = fopen($file, "r");
        while (($column = fgetcsv($file, ",")) !== FALSE){
            $fName = $column[1];
            $lName = $column[2];
            $phone = $column[3];
            $email = $column[4];
            $address = $column[5];
            $city = $column[6];
            $province = $column[7];
            $postal = $column[8];
            $dob = $column[9];
            $id = $column[10];
            $stmt->execute();
            

        }
        $stmt->close();
        @fclose($file);
    }
    $conn->close();

?>


<form method="post" enctype="multipart/form-data">
    <input type="file" name="file" value="file">
    <button type="submit" name="upload" value="upload">Upload</button>
</form>