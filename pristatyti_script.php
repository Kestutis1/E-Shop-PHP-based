<?php

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
                          if (strlen($name) >= 100) {
                                header("Location: pristatyti.php?pristatymas=name_length");
                                exit();
                            } else {
                               if (strlen($sur_name) >= 100) {
                                    header("Location: pristatyti.php?pristatymas=surname_length");
                                    exit();
                               } else {
                                   if (strlen($telefonas) > 12) {
                                        header("Location: pristatyti.php?pristatymas=tel_length");
                                        exit();
                                   } else {
                                      if (strlen($adres) >= 500) {
                                          header("Location: pristatyti.php?pristatymas=adres_length");
                                          exit();
                                      } else {
                                          if (strlen($mail) >= 150) {
                                              header("Location: pristatyti.php?pristatymas=mail_length");
                                              exit();
                                          } else {
                                              if (strlen($zip) > 5) {
                                                  header("Location: pristatyti.php?pristatymas=zip_length");
                                                  exit();
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
































 ?>
