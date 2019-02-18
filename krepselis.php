<?php
include("db.php");
session_start();
$seans = $_COOKIE["PHPSESSID"];
$display_block = "<h3>Jūsų prekių krepšelis.</h3>";

// IDEA: Susirandam pirkėjo pirkinius iš duombazės pagal seanso id.
$get_cart_sql = "SELECT st.id, si.prekės_pavadinimas, si.prekės_kaina,
                st.sel_item_qty, st.sel_item_size, st.sel_item_color FROM
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
    <th>Viso mokėti</th>
    <th>Veiksmas</th>
    </tr>";

    while ($krepselis = mysqli_fetch_array($get_cart_res)) {
      $id = $krepselis['id'];
      $pavadinimas = $krepselis['prekės_pavadinimas'];
      $kaina = $krepselis['prekės_kaina'];
      $kiekis = $krepselis['sel_item_qty'];
      $spalva = $krepselis['sel_item_color'];
      $dydis = $krepselis['sel_item_size'];
      $kainu_suma = sprintf("%.02f", $kaina*$kiekis);

    $display_block .= "
    <tr>
    <td align='center'>$pavadinimas<br /></td>
    <td align='center'>$dydis<br /></td>
    <td align='center'>$spalva<br /></td>
    <td align='center'>$kaina<br /></td>
    <td align='center'>$kiekis<br /></td>
    <td align='center'>$kainu_suma<br /></td>
    <td align='center'><a href='pasalinti_krep.php?id=$id'>Pašalinti iš krepšelio</a><br /></td>
    </tr>";
    }

$display_block .= "</table>";

}
// IDEA: Pradedam informacijos švedimą į ekraną.

include("header.php");

echo $display_block;

include("footer.php");
 ?>
