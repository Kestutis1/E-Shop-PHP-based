<?php
include("db.php");
include("header.php");
?>
<section><article><div class = 'flex-container'>
<h1>Užsiregistruoti</h1>

  <form class="plotis" action="sign_script.php" method="post">
    <input type="text" name="first" placeholder="Vardas" value="">
    <input type="text" name="last" placeholder="Pavardė" value="">
    <input type="text" name="email" placeholder=" E-paštas" value="">
    <input type="text" name="uid" placeholder="Vartotojo vardas" value="">
    <input type="password" name="pwd" placeholder="Slaptažodis" value="">
    <button type="submit" name="submit">Registruotis</button>
  </form>

</section></article></div>

<?php
include("footer.php");
?>
