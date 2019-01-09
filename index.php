<?php
  include('header.php');
  include('db.php');

    $dispaly_block = "<h1>Prekių kategorijos</h1>
    <p>Pasirinkite kategoriją pamatytį jos prekes</p>";

    // IDEA: Kategorijų rodymas
    $get_cats_sql = "SELECT id, kat_pavadinimas, kat_aprašymas FROM
                      prekiu_kategorijos ORDER BY kat_pavadinimas";
    $get_cats_res = mysqli_query(getPrisijungimas(), $get_cats_sql)
                      or die(mysqli_error(getPrisijungimas()));

if (mysqli_num_rows($get_cats_res) < 1) {
    $dispaly_block = "<p>Atsiprašome nėra kategorijų peržiūrėti</p>";
} else {
    while ($cats = mysqli_fetch_array($get_cats_res)) {
      $cat_id = $cats['id'];
      $cat_title = strtoupper(stripslashes($cats['kat_pavadinimas']));
      $cat_desc = stripslashes($cats['kat_aprašymas']);

      $dispaly_block .= "<p><strong><a href=\"".$_SERVER["PHP_SELF"].
      "?cat_id=".$cat_id."\">".$cat_title."</a></strong><br />"
      .$cat_desc."</p>";


    }
}

echo $dispaly_block;

 ?>
<?php include('footer.php'); ?>
