<?php

  if (isset($_GET['logout'])) {
      session_start();
      session_unset();
      session_destroy();
      header("Location: index.php");
      exit();
   }
  else {
    header("Location: index.php");
    exit();
  }

?>
