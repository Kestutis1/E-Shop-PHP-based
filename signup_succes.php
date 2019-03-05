<?php
include ("header.php");

if (isset($_GET['signup'])) {
   if ($_GET['signup'] == "succes") {
     echo "<h3>Sveikiname sėkmingai užsiregistravus</h3></br>
     <a href='login.php'>Prisijungti</a>";
   }
} else {
  header("Location: index.php");
}
include ("footer.php");
 ?>
