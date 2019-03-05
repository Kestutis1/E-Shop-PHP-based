<?php
include("db.php");
include("header.php");
    $uid = (isset($_POST['uid']) == true) ?  $_POST['uid'] : '';
    $pwd = (isset($_POST['pwd']) == true) ?  $_POST['pwd'] : '';

    // IDEA: Jaigu gavome error bandydami prisijungti atspausdiname žinute;
    if (isset($_GET['login'])) {
       if ($_GET['login'] == "error") {
         $login = "<h3>Jums nepavyko prisijungti.</h3>";
       }
    } else {
      $login = "";
    }
?>
<section><article><div class = 'flex-container'>
<h1>Prisijungimas</h1>
  <?php echo $login; ?>
  <form class="plotis" action="<?php echo htmlspecialchars('login_script.php');?>" method="post">
    <input type="text" name="uid" value="<?php echo $uid; ?>" placeholder="Vartotojo vardas arba e-paštas">
    <input type="password" name="pwd" value="<?php echo $pwd; ?>" placeholder="Slaptažodis">
    <button type="submit" name="submit">Prisijungti</button>
  </form>

<a href="signup.php">Registruotis</a>

</section></article></div>


<?php
include("footer.php");
 ?>
