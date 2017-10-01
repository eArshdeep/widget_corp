<?php
  define("DB_SERVER", "localhost");
  define("DB_USER", "dev_ops");
  define("DB_PASS", "apply_your_self");
  define("DB_NAME", "widget_corp");

  $db = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

  // check for db connection errors
  if(mysqli_connect_errno()){
    $message = "Attempt to connect to database failed. ";
    $message .= "(" . mysqli_connect_errno() . ") ";
    $message .= mysqli_connect_error();
    die($message);
  }
?>
