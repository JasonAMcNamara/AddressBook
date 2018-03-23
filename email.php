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

<form action="/project1/send.php" id="massEmail">
    <label for="subject">Subject</label> <br>
    <input type="text" placeholder="Enter subject here" name="subject"> 
    <button type="submit" name="submit">Send Mass Email</button> 
    
</form>
    <label for="message">Message</label> <br>
    <textarea rows="6" cols="50" name="message" form="massEmail">Enter message here</textarea> <br>