<?php
include("db.php");

// IDEA: Jaigu gavom id ištrinam prekę iš krepšelio lentelės.
if (isset($_GET['id'])) {


    $pasalinti_preke_sql = "DELETE FROM krepselis WHERE
                        item_id = '".$_GET["id"]."'and session_id = '".$_COOKIE["PHPSESSID"]."'";
    $pasalinti_preke_res = mysqli_query(getPrisijungimas(), $pasalinti_preke_sql)
                            or die(mysqli_error(getPrisijungimas()));

// IDEA: Ištrynus prekę grįžtam į krepšelio puslapį.
    header("Location: krepselis.php");
    exit;

} else {
   header("Location: index.php");
}
 ?>
