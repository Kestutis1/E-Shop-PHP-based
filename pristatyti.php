<?php

include("header.php");
include("db.php");
$seans = $_COOKIE["PHPSESSID"];
$pristatymas = "";

// IDEA: Pasitikrinu ar vartotojas šeipsau užklydo jai taip siunčiu į index.
if (!isset($_POST['submit'])) {
  if (!isset($_GET['pristatymas'])) {
        header("Location: index.php");
  }
}
// IDEA: Pradedu html formą kuruoje gausim pristatymo duomenis.
?>

<section><article><div class = 'flex-container'>
    <h2>Kam pristatyti prekes?</h2>

    <!-- Išsispaussdinam pranešimą jai tokių yra. -->
    <h4><?php echo $pristatymas; ?></h4>

    <form class="plotis" action="<?php echo htmlspecialchars('pristatyti_script.php'); ?>" method="post">
    <input type="text" name="name" placeholder="Vardas">
    <input type="text" name="sur_name" placeholder="Pavardė">
    <input type="text" name="telefonas" placeholder="Telefonas">
    <input type="text" name="adres" placeholder="Adresas">
    <input type="text" name="mail" placeholder="Jūsų elektroninio pašto adresas">
    <input type="number" name="zip" placeholder="Jūsų pašto kodas">
    <button type="submit" name="submit">Tęsti</button>
    </form>

</section></article></div>



<?php
include("footer.php");

?>
