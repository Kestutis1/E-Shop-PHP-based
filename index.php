<?php
// IDEA: Įsikeliam prisijungimą prie duombazės.
include('db.php');
    $display_block = "<h1>Prekių kategorijos</h1>
    <p>Pasirinkite kategoriją pamatytį jos prekes:</p><br />";
    // IDEA: Kategorijų rodymas
    $get_cats_sql = "SELECT id, kat_pavadinimas, kat_aprašymas FROM
                      prekiu_kategorijos ORDER BY kat_pavadinimas";
    $get_cats_res = mysqli_query(getPrisijungimas(), $get_cats_sql)
                      or die(mysqli_error(getPrisijungimas()));
if (mysqli_num_rows($get_cats_res) < 1) {
    $display_block = "<p>Atsiprašome nėra kategorijų peržiūrėti</p><br />";
} else {
    while ($cats = mysqli_fetch_array($get_cats_res)) {
      $cat_id = $cats['id'];
      $cat_title = strtoupper(stripslashes($cats['kat_pavadinimas']));
      $cat_desc = stripslashes($cats['kat_aprašymas']);
      $display_block .= "<p><strong><a href=\"".$_SERVER["PHP_SELF"].
      "?cat_id=".$cat_id."\">".$cat_title."</a></strong><br />"
      .$cat_desc."</p><br />";
      if (isset($_GET["cat_id"])) {
            if($_GET["cat_id"] == $cat_id) {
              // IDEA: gaunami duomenys.
              $get_items_sql = "SELECT id, prekės_pavadinimas, prekės_kaina FROM
              prekes WHERE kat_id ='".$cat_id."'
              ORDER BY prekės_pavadinimas";
              $get_items_res = mysqli_query(getPrisijungimas(), $get_items_sql)
                                or die(mysqli_error(getPrisijungimas()));
              if (mysqli_num_rows($get_items_res) < 1) {
                  $display_block = "<p>Atsiprašome nėra prekių šioje kategorijoje</p><br />";
                } else {
                      $display_block .="<ul>";
                      while ($items = mysqli_fetch_array($get_items_res)) {
                        $item_id = $items['id'];
                        $item_title = stripslashes($items['prekės_pavadinimas']);
                        $item_price = $items['prekės_kaina'];
                        $display_block .= "<li><a href=\"showitem.php?item_id="
                        .$item_id."\">".$item_title."</a></strong>
                        (€ ".$item_price.")</li><br />";
                      }
                      $display_block .="</ul><br />";
                }
                // IDEA: Atlaisvinami rezultatai.
                mysqli_free_result($get_items_res);
              }
            }
          }
        }
    // IDEA: Rezultato atlaisvinimas.
    mysqli_free_result($get_cats_res);
// IDEA: Įsikeliu pagrindiius html tagus ir pradedu puslapio atvaizdavimą.
include('header.php');
// IDEA: Pagrindinio bloko atvaizdavimas.
    echo "<section><article><div class = 'flex-container'>
          <div><h1>Parduotuvės prekių pasirinkimas
          </h1><br /><div class = 'centre'>
          $display_block</div></div></div></article></section>";
include('footer.php'); ?>
