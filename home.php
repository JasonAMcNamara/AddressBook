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
    $password = "";
    $dbName = $config["dbName"];
    $tblName = $config["tblName"];
    $tblNameLogin = $config["tblNameLogin"];

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
                $contact .=
                    "<tr><td>" . $row["fName"]. " " . $row["lName"] . "</td>" . 
                    "<td>" . $row["phone"] . "</td>" .
                    "<td>". $row["email"] . "</td>" .
                    "<td>" . $row["address"] . "</td>" .
                    "<td>" . $row["city"] . "</td>" .
                    "<td>". $row["province"] . "</td>" .
                    "<td>". $row["postal"] . "</td>".
                    "<td>". $row["dob"] . "</td>" . 
                    "<td> <form action='/project1/edit'> <input type='hidden' name='id 'value='" . $row["id"] . "'/><button type='Submit' name='id' value='" . $row["id"] . "'>Edit Record</button> </form></td>'" . 
                    "<td> <form action='/project1/delete'> <input type='hidden' name='id 'value='" . $row["id"] . "'/><button type='Submit' name='id' value='" . $row["id"] . "'>Delete Record</button> </form></td></tr>";
            }
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
    <h2>All contacts</h2>
    <a href="/project1/logout"><button type="submit" id="logout" value="Logout">Logout</button></a>
    <a href="/project1/addNew"><button type="submit" id="addNew" value="New Contact">Add New Contact</button></a>
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
                <th>Edit Record: </th>
                <th>Remove Record: </th>
            </tr>
            <?php echo $contact ?>
        </table>
    </body>
</html>
