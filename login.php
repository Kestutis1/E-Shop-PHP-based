<?php
include("db.php");
include("header.php");
?>
<section><article><div class = 'flex-container'>
<h1>Prisijungimas</h1>

  <form class="plotis" action="<?php echo htmlspecialchars('login_script.php');?>" method="post">
    <input type="text" name="uid" placeholder="Vartotojo vardas">
    <input type="password" name="pwd" placeholder="Slaptažodis">
    <button type="submit" name="submit">Prisijungti</button>
  </form>

<a href="signup.php">Registruotis</a>

</section></article></div>


<?php
include("footer.php");
 ?>
