<?php

  session_start();

  function toast_message(){
    if(isset($_SESSION["message"])){
      $message = htmlentities($_SESSION["message"]);
      // create a line of code for javascript to toast a message using materialize.js and jquery.js
      $output = "Materialize.toast('$message', 4000);";
      echo $output;
      $_SESSION["message"] = null;
    }
  }

?>
