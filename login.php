<?php
include("db.php");
include("header.php");
?>
<section><article><div class = 'flex-container'>
<h2>Prisijungimas</h2>

<div class="nav-login">
  <form >
    <input type="text" name="uid" placeholder="Vartotojo vardas arba e-paštas" value="">
    <input type="password" name="pwd" placeholder="Slaptažodis" value="">
    <button type="submit" name="submit">Prisijungti</button>
  </form>
</div>

<a href="signup.php">Registruotis</a>

</section></article></div>


<?php
include("footer.php");
 ?>
