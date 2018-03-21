<?php
    $config = parse_ini_file("dbinfo.ini");
    $servername = $config["servername"];
    $username = $config["username"];
    $password = "";
    $dbName = $config["dbName"];
    $tblName = $config["tblName"];
    

    $contact = "";

    $conn = mysqli_connect($servername, $username, $password, $dbName) or die;

    

    $sql = "SELECT fName, lName, phone, email, address, city, province, postal, dob FROM $tblName";

    $result = mysqli_query($conn, $sql) or die;
    
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $contact .=
                "<tr><td>" . $row["fName"]. " " . $row["lName"] . "</td>" . 
                "<td>" . $row["phone"]. "</td>".
                "<td>". $row["email"]. "</td>".
                "<td>" . $row["address"]. "</td>".
                "<td>" . $row["city"]. "</td>".
                "<td>". $row["province"]. "</td>".
                "<td>". $row["postal"]. "</td>".
                "<td>". $row["dob"]. "</td></tr>";
        }
    } else {
        $contact = "0 results";
    }

    $conn->close();

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Document</title>
    </head>
    <body>
    <h2>All contacts</h2> <br>
    <a href="/project1/addNew"><input type="button" id="addNew" value="New Contact"></a>
        <table>
            <tr>
                <th>Name: </th>
                <th>Phone: </th>
                <th>Email: </th>
                <th>Address: </th>
                <th>City: </th>
                <th>Province: </th>
                <th>Postal: </th>
                <th>Date of Birth: </th>
            </tr>
            <?php echo $contact ?>
        </table>
    </body>
</html>
