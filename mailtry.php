
  <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
   To: <input type="text" name="to_email"><br>
   Message: <textarea rows="10" cols="20" name="message"></textarea><br>
   <input type="submit" name="submit" value="Send Email">
  </form>

 <?php
  if (isset($_POST["to_email"])) {
    $to_email = $_POST["to_email"];
    $subject = "send mail";
    $body = $_POST["message"];
 
    if ( mail($to_email, $subject, $body)) {
      echo("Email successfully sent to $to_email...");
    } else {
      echo("Email sending failed...");
    }
  }

?>