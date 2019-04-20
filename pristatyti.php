<?php

include("header.php");
include("db.php");
$seans = $_COOKIE["PHPSESSID"];
$pristatymas = "";


// IDEA: Pasitikrinu ar vartotojas šeipsau užklydo jai taip siunčiu į index.
if (!isset($_POST['submit'])) {
  if (!isset($_GET['pristatymas'])) {
        header("Location: index.php");
        exit();
  } else {
      $pristatymas = $_GET['pristatymas'];
  }
}

// IDEA: Pradedu error žinučių nustatymą.
switch ($pristatymas) {
  case 'empty':
    $pristatymas = "Užpildėte nevisus laukus!";
    break;
  case 'neisraidziu':
    $pristatymas = "Vardas ir pavardė turi būti tik iš raidžių!";
    break;
  case 'neisskaiciu':
    $pristatymas = "Telefono numeris turi būti iš skaičių!";
    break;
  case 'zip_neiskaiciu':
    $pristatymas = "Pašto kodas turi būti tik iš skaičių!";
    break;
  case 'email':
    $pristatymas = "Tokio elektroninio pašto adreso nėra!";
    break;
  case 'name_length':
    $pristatymas = "Vardas negali būti ilgesnis kaip 100 simbolių!";
    break;
  case '$sur_name':
    $pristatymas = "Pavardė negali būti ilgesnė kaip 100 simbolių!";
    break;
  case 'tel_length':
    $pristatymas = "Telefono numeris negali būti ilgesnis kaip 12 simbolių!";
    break;
  case 'adres_length':
    $pristatymas = "Adresas negali būti ilgesnis kaip 500 simbolių!";
    break;
  case 'mail_length':
    $pristatymas = "elektroninio pašto adresas negali būti ilgesnis kaip 150 simbolių!";
    break;
  case 'zip_length':
    $pristatymas = "Pašto kodas negali būti ilgesnis kaip 5 simboliai!";
    break;

  default:
    $pristatymas = "";
    break;
}

// IDEA: Pasiimu iš post du paslėptus kintamuosius, kad persiūsti su formą į kitą puslapį
  $bendra_suma = $_POST['bendra_suma'];
  $bendras_kiekis = $_POST['bendras_kiekis'];

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
    <input type= 'hidden' name='bendra_suma' value='<?php echo $bendra_suma; ?>' />
    <input type= 'hidden' name='bendras_kiekis' value='<?php echo $bendras_kiekis; ?>' />
    <button type="submit" name="submit">Tęsti</button>
    </form>

</section></article></div>



<?php
include("footer.php");

?>
