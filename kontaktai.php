<?php
include("db.php");
include("header.php");
// IDEA: Errorų pranešimai jai tokių yra
$mailsend = "";

if (isset($_GET['mailsend'])) {
      switch ($_GET['mailsend']) {
        case 'empty':
            $mailsend = "Užpildėte nevisus laukus!";
          break;
        case 'email':
            $mailsend = "Elektroninio pašto adresas įvestas neteisingai!";
          break;
        case 'succes':
            $mailsend = "Ačiū už jūsų žinutę!";
          break;
        default:
            $mailsend = "";
          break;
      }
}
?>
<section><article><div class = 'flex-container'>
    <h2>Susisiekite su mumis</h2>

    <!-- Išsispaussdinam pranešimą jai tokių yra. -->
    <h4><?php echo $mailsend; ?></h4>

    <form class="plotis" action="<?php echo htmlspecialchars('kontaktai_script.php'); ?>" method="post">
    <input type="text" name="name" placeholder="Vardas Pavardė">
    <input type="text" name="mail" placeholder="Jūsų elektroninio pašto adresas">
    <input type="text" name="pavadinimas" placeholder="Pavadinimas">
    <textarea name="message" rows="8" cols="43" placeholder="Žinutė"></textarea>
    <button type="submit" name="submit">Siūsti</button>
    </form>

</section></article></div>


<?php
include("footer.php");
 ?>
