<?php
    session_start();
    if (isset($_SESSION['user'])) {
        $sessionUser = $_SESSION['user'];
    } else{
        session_destroy();
        header("Location: /project1");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Document</title>
    </head>
    <body>
        <form action="/project1/add.php">
            First Name: <input type="text" name="fName" id="fName"/><br>
            Last Name: <input type="text" name="lName" id="lName"/><br>
            Phone: <input type="text" name="phone" id="phone"/><br>
            Email: <input type="text" name="email" id="email"/><br>
            Address: <input type="text" name="address" id="address"/><br>
            City: <input type="text" name="city" id="city"/><br>
            Province: <input type="text" name="province" id="province"/><br>
            Postal Code:<input type="text" name="postal" id="postal"/><br>
            Date of Birth: <input type="text" name="dob" id="dob"/><br>
            <input type="submit" name="submit" value="submit"/>
        </form>
    </body>
</html>