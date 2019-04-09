<?php

include("header.php");
include("db.php");
$seans = $_COOKIE["PHPSESSID"];
$display_block = "<h3>Jūsų užsakymas.</h3>";

// IDEA: Pasitikrinam ar vartotojas ne šeipsau užklydo ir iš get pasiimam pora kintamūsjų.
if (!isset($_GET['submit'])) {
    header("Location: index.php");
    } else {
      $bendras_kiekis = $_GET['bendras_kiekis'];

      $bendra_suma = $_GET['bendra_suma'];

      // IDEA: Susirandam pirkėjo pirkinius iš duombazės pagal seanso id.
      $get_cart_sql = "SELECT st.id, si.prekės_pavadinimas, si.prekės_kaina,
                      st.sel_item_qty, st.sel_item_size, st.item_id, st.sel_item_color FROM
                      krepselis AS st LEFT JOIN prekes AS si ON
                      si.id = st.item_id WHERE session_id = '".$_COOKIE["PHPSESSID"]."'";

      $get_cart_res = mysqli_query(getPrisijungimas(), $get_cart_sql)
                      or die(mysqli_error(getPrisijungimas()));


      if(mysqli_num_rows($get_cart_res) <1) {
        // IDEA: Atspausdinam pranešimą jaigu nėra prekių užsakyme.
        $display_block .= "<h3>Atsiprašome įvyko klaida. Jūs neturite prekių krepšelyje.</h3>
                          <p>Prašau <a href ='index.php'>tęsti apsipirkimą</a></p>";
      } else {

          while ($krepselis = mysqli_fetch_array($get_cart_res)) {
            $id = $krepselis['item_id'];
            $pavadinimas = $krepselis['prekės_pavadinimas'];
            $kaina = $krepselis['prekės_kaina'];
            $kiekis = $krepselis['sel_item_qty'];
            $_SESSION["krepselis"] = $kiekis;
            $spalva = $krepselis['sel_item_color'];
            $dydis = $krepselis['sel_item_size'];
            $kainu_suma = sprintf("%.02f", $kaina*$kiekis);
            $bendra_suma += $kainu_suma;
            $bendras_kiekis += $kiekis;

          $display_block .= "
          <p>$pavadinimas<br /></p>
          <p>$dydis<br /></p>
          <p>$spalva<br /></p>
          <p>$kaina €<br /></p>
          <p>$kiekis<br /></p>
          <p>$kainu_suma €<br /></p>
          <P>Viso prekių $bendras_kiekis</P>
          <br /><P>Mokėtina suma  $bendra_suma</P>";
          }
      }


  echo "$display_block";

    }

include("footer.php");

 ?>
