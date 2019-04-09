<?php
include("db.php");
$seans = $_COOKIE["PHPSESSID"];
$display_block = "<h3>Jūsų prekių krepšelis.</h3>";
$bendra_suma = 0;
$bendras_kiekis = 0;


// IDEA: Susirandam pirkėjo pirkinius iš duombazės pagal seanso id.
$get_cart_sql = "SELECT st.id, si.prekės_pavadinimas, si.prekės_kaina,
                st.sel_item_qty, st.sel_item_size, st.item_id, st.sel_item_color FROM
                krepselis AS st LEFT JOIN prekes AS si ON
                si.id = st.item_id WHERE session_id = '".$_COOKIE["PHPSESSID"]."'";

$get_cart_res = mysqli_query(getPrisijungimas(), $get_cart_sql)
                or die(mysqli_error(getPrisijungimas()));


if(mysqli_num_rows($get_cart_res) <1) {
  // IDEA: Atspausdinam pranešimą jaigu nėra prekių krepšelyje.
  $display_block .= "<h3>Jūs neturite prekių krepšelyje.</h3>
                    <p>Prašau <a href ='index.php'>tęsti apsipirkimą</a></p>";
} else {
    $display_block .= "
    <table celpadding='3' cellspacing='2' border='1' width='98'>
    <tr>
    <th>Pavadinimas</th>
    <th>Dydis</th>
    <th>Spalva</th>
    <th>Kaina</th>
    <th>Kiekis</th>
    <th>Suma</th>
    <th>Veiksmas</th>
    </tr>";

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
    <tr>
    <td align='center'>$pavadinimas<br /></td>
    <td align='center'>$dydis<br /></td>
    <td align='center'>$spalva<br /></td>
    <td align='center'>$kaina €<br /></td>
    <td align='center'>$kiekis<br /></td>
    <td align='center'>$kainu_suma €<br /></td>
    <td align='center'><a href='pasalinti_krep.php?id=$id'>Pašalinti</a><br /></td>
    </tr>";
    }

$display_block .= "</table>";

}
// IDEA: Pradedam informacijos švedimą į ekraną.

include("header.php");
$_SESSION['kiekis'] = $bendras_kiekis;
$iki = $_SESSION['kiekis'];
echo "<section><article><div class = 'flex-container'>
      <div><div class = 'centre'>
      $display_block</div></div><br /><P>Bendra mikėtina suma $bendra_suma
      €</P></div><form class='text_center' action='pristatyti.php' method='post'>
          <button type='submit' name='submit'>Tęsti</button>
      </form>
    </section>
  </article>";
?>


<?php include("footer.php"); ?>
