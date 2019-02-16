<?php
include("header.php");
include("db.php");
session_start();
$seans = $_COOKIE["PHPSESSID"];
// IDEA: Susirandam pirkėjo pirkinius iš duombazės pagal seanso id.
$get_cart_sql = "SELECT st.id, si.prekės_pavadinimas, si.prekės_kaina,
                st.sel_item_qty, st.sel_item_size, st.sel_item_color FROM
                krepselis AS st LEFT JOIN prekes AS si ON
                si.id = st.item_id WHERE session_id = '".$_COOKIE["PHPSESSID"]."'";

$get_cart_res = mysqli_query(getPrisijungimas(), $get_cart_sql)
                or die(mysqli_error(getPrisijungimas()));

                while ($krepselis = mysqli_fetch_array($get_cart_res)) {
                    echo $krepselis['sel_item_qty'];
                    echo $krepselis['id'];
                    echo $krepselis['sel_item_size'];
                    echo $krepselis['sel_item_color'];
                }




if(mysqli_num_rows($get_cart_res) <1) {
  // IDEA: Atspausdinam pranešimą jaigu nėra prekių krepšelyje.
  $display_block .= "<h3>Jūs neturite prekių krepšelyje.</h3>
                    <p>Prašau <a href ='index.php'>tęsti apsipirkimą</a></p>";
}














include("footer.php");
 ?>
