<?php

include("header.php");
include("db.php");

session_start();

if (isset($_POST['sel_item_id'])) {
    // IDEA: patikrinam prekę. Pasiimam pavadinimą ir kainą.

    $get_prekesInfo_sql = "SELECT prekės_pavadinimas FROM prekes
    WHERE id ='".$_POST["sel_item_id"]."'";


    $get_prekesInfo_res = mysqli_query(getPrisijungimas(), $get_prekesInfo_sql)
                          or die(mysqli_error(getPrisijungimas()));

    if (mysqli_num_rows($get_prekesInfo_res < 1)) {
      // IDEA: Jaigu prekių lentelėje nėra nė vieno rezultato gražinam į pradinį puslapį ir pasisiunčiam kintamajį.
          header("Location: indx.php?neikrepseli=nepavyko");
          exit;
    } else{
        // IDEA: Kitu atveju imam informaciją iš globalių kintamūjų. Kelsim ją į krepšelio lentelę.
        while($prekes_info = mysqli_fetch_array($get_prekesInfo_res)) {
          $item_title = stripslashes($prekes_info['prekės_pavadinimas']);
        }
           $pridkrepseli_sql = "INSERT INTO krepselis (session_id, item_id, sel_item_qty, sel_item_size, sel_item_color, date_added)
                                VALUES ('".$_COOKIE["PHPSESSID"]."',
                                '".$_POST["sel_item_id"]."',
                                '".$_POST["sel_item_qty"]."',
                                '".$_POST["sel_item_size"]."',
                                '".$_POST["sel_item_color"]."', now())";
          $addtocart_res = mysqli_query(getPrisijungimas(), $pridkrepseli_sql)
                            or die(mysqli_error(getPrisijungimas()));

        // IDEA: Nukreipiam į krepšelio puslapį.
        header("Location: krepselis.php");
        exit();
        }

    } else {
       // IDEA: Jai kažkas negerai gražinam į pradinį puslapį.
       header("Location: index.php");
       exit();
    }

include ("footer.php");

 ?>
