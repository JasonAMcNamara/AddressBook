
<?php
    $config = parse_ini_file("dbinfo.ini");
    $servername = $config["servername"];
    $username = $config["username"];
    $password = "";
    $dbName = $config["dbName"];
    $tblName = $config["tblName"];

    $conn = mysqli_connect($servername, $username, $password, $dbName) or die;
    $id=$_GET['id'];
    $sql = "SELECT id, fName, lName, phone, email, address, city, province, postal, dob FROM $tblName WHERE id=$id";
    $result = mysqli_query($conn, $sql) or die;
    $row = $result->fetch_assoc();
    $fName = $row["fName"];
    $lName = $row["lName"];
    $phone = $row["phone"];
    $email = $row["email"];
    $address = $row["address"];
    $city = $row["city"];
    $province = $row["province"];
    $postal = $row["postal"];
    $dob = $row["dob"];
    
    ?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Document</title>
    </head>
    <body>
        <form action="/project1/update.php">
        <input type="hidden" name="id" value="<?php echo $id?>"/>
            First Name: <input type="text" name="fName" id="fName" value='<?php echo $fName?>'/><br>
            Last Name: <input type="text" name="lName" id="lName" value='<?php echo $lName?>'/><br>
            Phone: <input type="text" name="phone" id="phone" value='<?php echo $phone?>'/><br>
            Email: <input type="text" name="email" id="email" value='<?php echo $email?>'/><br>
            Address: <input type="text" name="address" id="address" value='<?php echo $address?>'/><br>
            City: <input type="text" name="city" id="city" value='<?php echo $city?>'/><br>
            Province: <input type="text" name="province" id="province" value='<?php echo $province?>'/><br>
            Postal Code:<input type="text" name="postal" id="postal" value='<?php echo $postal?>'/><br>
            Date of Birth: <input type="text" name="dob" id="dob" value='<?php echo $dob?>'/><br>
            <input type="submit" name="submit" value="submit"/>
        </form>
    </body>
</html>