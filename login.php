<?php
include("db.php");
include("header.php");
?>
<section><article><div class = 'flex-container'>
<h1>Prisijungimas</h1>

  <form class="plotis" action="login_script.php" method="post">
    <input type="text" name="uid" placeholder="Vartotojo vardas arba e-paštas">
    <input type="password" name="pwd" placeholder="Slaptažodis">
    <button type="submit" name="submit">Prisijungti</button>
  </form>

<a href="signup.php">Registruotis</a>

</section></article></div>


<?php
include("footer.php");
 ?>
