<?php

if(isset($_POST['submit']))
{
   verify();
} 
$feedback = "";
function verify(){
    
    $user = $_POST["username"];
    $pass = $_POST["password"];
    
    $config = parse_ini_file("dbinfo.ini");
    $servername = $config["servername"];
    $username = $config["username"];
    $password = "";
    $dbName = $config["dbName"];
    $tblNameLogin = $config["tblNameLogin"];
    
    $conn = mysqli_connect($servername, $username, $password, $dbName) or die;
    
    $sql = "SELECT id, username, hash FROM $tblNameLogin";
    
    $result = mysqli_query($conn, $sql) or die;
    
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if (password_verify($pass, $row['hash']) == true && $user == $row['username']){
                session_start();
                session_unset();
                $_SESSION['user'] = $user;
                header("Location: /project1/home");
                exit;
            } else{
                $feedback = "Username or Password incorrect";
            }
        }
    } 
    $conn->close();
}
?>
<form method="post" action="/project1/">
  

  <div class="container">
    <label for="username"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="username" required>

    <label for="password"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" required>
    <button type="submit" name="submit">Login</button> 
  </div>
  </div>
</form>
<?php echo $feedback ?>