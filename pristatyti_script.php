<?php
include_once("header.php");
include_once("db.php");

if (!isset($_POST['submit'])) {
      header("Location: index.php");
      exit();
}

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string(getPrisijungimas(), $_POST['name']);
    $sur_name = mysqli_real_escape_string(getPrisijungimas(), $_POST['sur_name']);
    $telefonas = mysqli_real_escape_string(getPrisijungimas(), $_POST['telefonas']);
    $adres = mysqli_real_escape_string(getPrisijungimas(), $_POST['adres']);
    $mail = mysqli_real_escape_string(getPrisijungimas(), $_POST['mail']);
    $zip = mysqli_real_escape_string(getPrisijungimas(), $_POST['zip']);
    $bendra_suma = mysqli_real_escape_string(getPrisijungimas(), $_POST['bendra_suma']);
    $bendras_kiekis = mysqli_real_escape_string(getPrisijungimas(), $_POST['bendras_kiekis']);

    $authorization = $_COOKIE["PHPSESSID"];
}

// IDEA: Pradedu kintamūjų validaciją.
    if (empty($name) || empty($sur_name) || empty($telefonas) || empty($adres) || empty($mail)) {
          header("Location: pristatyti.php?pristatymas=empty");
          exit();
      // IDEA: Pasitikrinam ar varde pavardėje nėra skaičių ar kitų neleistinų simbolių.
      } else {
          if (!preg_match("/^[-\pL&]+$/u", $name) || !preg_match("/^[-\pL&]+$/u", $sur_name)) {
                header("Location: pristatyti.php?pristatymas=neisraidziu");
                exit();
            } else {
                if (!preg_match("/^[\+0-9\-\(\)\s]*$/", $telefonas)) {
                      header("Location: pristatyti.php?pristatymas=neisskaiciu");
                      exit();
                  } else{
                     if (!preg_match("/^[\+0-9\-\(\)\s]*$/", $zip)) {
                          header("Location: pristatyti.php?pristatymas=zip_neiskaiciu");
                          exit();
                  } else {
                      if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                            header("Location: pristatyti.php?pristatymas=email");
                            exit();
                      } else {
                          if (strlen($name) > 100) {
                                header("Location: pristatyti.php?pristatymas=name_length");
                                exit();
                            } else {
                               if (strlen($sur_name) > 100) {
                                    header("Location: pristatyti.php?pristatymas=surname_length");
                                    exit();
                               } else {
                                   if (strlen($telefonas) > 12) {
                                        header("Location: pristatyti.php?pristatymas=tel_length");
                                        exit();
                                   } else {
                                      if (strlen($adres) > 500) {
                                          header("Location: pristatyti.php?pristatymas=adres_length");
                                          exit();
                                      } else {
                                          if (strlen($mail) > 150) {
                                              header("Location: pristatyti.php?pristatymas=mail_length");
                                              exit();
                                          } else {
                                              if (strlen($zip) > 5) {
                                                  header("Location: pristatyti.php?pristatymas=zip_length");
                                                  exit();
                                              } else {
                                                  $sql = "INSERT INTO užsakymo_info (order_name, order_surname, order_addres, order_zip, order_tel, order_email,
                                                                                    status, order_date, bendras_kiekis, bendra_suma)
                                                          VALUES('$name', '$sur_name', '$adres', '$zip', '$telefonas', '$mail', ' ', now(), '$bendras_kiekis', '$bendra_suma');";

                                                  $res = mysqli_query(getPrisijungimas(), $sql);
                                                  $uzsakymo_id = mysqli_insert_id(getPrisijungimas());

                                                  // IDEA: Pradedu užsakymo prekių lentelės query

                                                  $uzsakytos_prekes_sql = "INSERT INTO užsakymo_prekės (sel_order_id, sel_item_id, sel_item_qty,
                                                    	                     sel_item_size, sel_item_color, sel_item_price)
                                                                           VALUES('$uzsakymo_id', '', '', '', '', '');";

                                                  $uzsakytos_prekes_res = mysqli_query(getPrisijungimas(), $uzsakytos_prekes_sql)
                                                                            or die(mysqli_error(getPrisijungimas()));



                                                          echo "<section><article><div class = 'flex-container'>
                                                                <div><h1>Jūsų užsakymas
                                                                </h1><br /><div class = 'centre'>
                                                                <P>$name</P><br />
                                                                <p>$sur_name</p><br />
                                                                <p>$adres</p><br />
                                                                <p>Pašto kodas $zip</p><br />
                                                                <p>Telefono numeris $telefonas</p><br />
                                                                <p>Elektroninis paštas $mail</p><br />
                                                                <p>Bendrai prekių $bendras_kiekis</p><br />
                                                                <p>Viso mokėti $bendra_suma €</p><br />
                                                                </div></div></div></article></section>";




                                                          echo "<form action ='apmokėti.php' method = 'post' >
                                                                <input type ='hidden' name = 'uzsakymoId' value = '' />
                                                                <input type ='hidden' name = 'vardas' value = '$name' />
                                                                <button type='submit' name='submit'>Apmokėti</button>
                                                                </form>
                                                                ";
                                    }
                                  }
                                }
                              }
                            }
                          }
                        }
                      }
                   }
                 }
               }
include_once("footer.php");
?>
