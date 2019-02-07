<?php
include('db.php');

$display_block = "<h1>Prekės aprašymas</h1>";

$get_items_sql = "SELECT c.id as kat_id, c.kat_pavadinimas, si.prekės_pavadinimas,
                    si.prekės_kaina, si.prekės_aprašymas FROM prekes
                    AS si LEFT JOIN prekiu_kategorijos AS c on c.id = si.kat_id
                    WHERE si.id = '".$_GET['item_id']."'";
$get_item_res = mysqli_query(getPrisijungimas(), $get_items_sql)
                  or die(mysqli_error(getPrisijungimas()));


if(mysqli_num_rows($get_item_res) < 1) {
    $display_block = "<p>Nepavyko atvaizduoti prekę</p>";
} else {
    while ($item_info = mysqli_fetch_array($get_item_res)) {
        $cat_id = $item_info['kat_id'];
        $cat_title = strtoupper(stripslashes($item_info['kat_pavadinimas']));
        $item_title = stripslashes($item_info['prekės_pavadinimas']);
        $item_price = $item_info['prekės_kaina'];
        $item_desc = stripslashes($item_info['prekės_aprašymas']);
        // $item_image = "img\prekė".$_GET['item_id'].".jpg";
        $prekesId = $_GET['item_id'];
    }

// IDEA: Pasitikrinam ar prekė turi nuotrauką
    $SQLfoto = "SELECT * FROM prekiu_nuotr WHERE prekės_id = '$prekesId'";
    $resultImage = mysqli_query(getPrisijungimas(), $SQLfoto);
      while ($rowImg = mysqli_fetch_assoc($resultImage)) {
        if ($rowImg['status'] == 1) {
                $item_image = "img\prekė".$_GET['item_id'].".jpg";
        } else {
                $item_image = "img\default.png";
        }
      }


// IDEA: Prekės atvaizdavimas su nuoroda į kategorijos puslapį.
$display_block .= "<p><strong>Prekė priklauso kategorijai
    <a href=\"index.php?cat_id=".$cat_id."\">".$cat_title."
    </a></strong></p><br />
    <h3>".$item_title."</h3>
    <img src= $item_image>
    <p><strong>Prekės aprašymas:</strong><br />".
    $item_desc."</p>
    <p><strong>Kaina:</strong> €".$item_price."</p>";


// IDEA: Atlaisvinam rezultatus.
  mysqli_free_result($get_item_res);


}

// IDEA: Prasideda skripto išvedimas į ekraną.
include('header.php');
    echo "<section><article><div class = 'flex-container'>
          <div class = 'preke'><div class = 'centre'>
          $display_block</div></div></div>
          </article></section>";
include('footer.php');
?>
