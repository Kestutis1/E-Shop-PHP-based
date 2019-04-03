<?php
      include('header.php');
      include('db.php');

?>


<section>


<?php


        // IDEA: Pradedu straipsnio įkėlimą į duombazę.
        function švarinamIvestis($data) {
              $data = trim($data);
              $data = stripslashes($data);
              $data = htmlspecialchars($data);
              return $data;
          }
      if(isset($_POST['ĮkeltiPrekę']))  {
      // IDEA: Susitvarkom kintamuosius.
            $katId = mysqli_real_escape_string(getPrisijungimas(), $_POST['kategorija']);
            $prePavadinimas = mysqli_real_escape_string(getPrisijungimas(), $_POST['prePavadinimas']);
            $preKaina = mysqli_real_escape_string(getPrisijungimas(), $_POST['preKaina']);
            $preAprašymas = mysqli_real_escape_string(getPrisijungimas(), $_POST['aprašymas']);

      // IDEA: Psitikrinu prekės informacijos kintamuosiuis ar jie užpildyti jai ne siunčiu atgal.
      if (empty($katId)) {
            header("location: prekiu_valdymas.php?sekme=emptyKatid");
            exit();
      }
      if(empty($prePavadinimas)) {
            header("location: prekiu_valdymas.php?sekme=emptyPavadinimas");
            exit();
      }
      if(empty($preKaina)) {
            header("location: prekiu_valdymas.php?sekme=emptyKaina");
            exit();
      }
      if(empty($preAprašymas)) {
            header("location: prekiu_valdymas.php?sekme=emptyAprašymas");
            exit();
      }

      // IDEA: Prasideda įkeltos nuotraukos kintamieji.
            $nuotrauka = $_FILES['nuotrauka'];
            $nuotraukaPavadinimas = $_FILES ['nuotrauka'] ['name'];
            $nuotraukaTmpPavadinimas = $_FILES ['nuotrauka'] ['tmp_name'];
            $nuotraukaSize = $_FILES ['nuotrauka'] ['size'];
            $nuotraukaError = $_FILES ['nuotrauka'] ['error'];
            $nuotraukaType = $_FILES ['nuotrauka'] ['type'];

      // IDEA: Pradedam apdoroti nuotrauką. Atskiriam nuotraukos failo tipa nuo pavadinimo.
            $nuotraukaExt = explode('.',$nuotraukaPavadinimas);
      // IDEA: failo tipa paverčiam mažosiomis raidėmis.
            $nuotraukaActualExt = strtolower(end($nuotraukaExt));
      // IDEA: Nusistatom leistinų nuotraukų tipus.
            $allowed = array('jpg','jpeg', 'png', 'pdf');




      // IDEA: Pradedam SQL ir kintaūjų įrašymą į duomenų bazę.
          $SQL = "INSERT INTO `prekes` (`id`, `kat_id`, `prekės_pavadinimas`, `prekės_kaina`, `prekės_aprašymas`)
                  VALUES (NULL, '$katId', '$prePavadinimas', '$preKaina', '$preAprašymas');";
          $ikeliam = mysqli_query(getPrisijungimas(), $SQL);

      // IDEA: Susigražinam prekės id kurį panaudosim nuotraukos pavadinime bei spalvai ir dydžiui.
          $last_id = mysqli_insert_id(getPrisijungimas());

      // IDEA: Jaigu administratorius nurodė įkeliam prekės splavą.
          if(isset($_POST['preSpalva'])) {

            $spalva = $_POST['preSpalva'];

            $SQL_spalva = "INSERT INTO `prekiu_spalvos` ( `prekės_id`, `prekės_spalva`)
                          VALUES('$last_id', '$spalva');";
            $ikeliamSpalva = mysqli_query(getPrisijungimas(), $SQL_spalva);
          }

      // IDEA: Jaigu administratorius nurodė įkeliam prekės dydį.
          if(isset($_POST['preDydis'])) {

            $dydis = $_POST['preDydis'];

            $SQL_dydis = "INSERT INTO `prekiu_dydis` ( `prekės_id`, `prekės_dydis`)
                          VALUES('$last_id', '$dydis');";
            $ikeliamDydi = mysqli_query(getPrisijungimas(), $SQL_dydis);
          }


      // IDEA: Jaigu administratorius neįkėlė prekei nuotraukos pradedam defaultinės nuotraukos kelio įkėlimą į duombazę.
                      if (empty($nuotraukaPavadinimas)) {
                        $SQL_foto = "INSERT INTO `prekiu_nuotr` ( `prekės_id`, `status`)
                                      VALUES('$last_id', 0);";
                        $ikeliamNuotrauka = mysqli_query(getPrisijungimas(), $SQL_foto);
                        header("location: prekiu_valdymas.php?sekme=defaultine");
                        exit();
                      }


      // IDEA: Tikrinam nuotrauką ir jai viskas gerai įkeliam ją į nuotraukų papkę.
                if (in_array($nuotraukaActualExt, $allowed)) {
                      if ($nuotraukaError === 0) {
                            if ($nuotraukaSize < 1000000) {

                              // IDEA: keičiam nuotraukos pavadinimą į unikalų.
                                  $naujasNuotrPav = "prekė".$last_id.".".$nuotraukaActualExt;

                                  $nuotraukosIkelimas = 'img/'.$naujasNuotrPav;
                                  move_uploaded_file($nuotraukaTmpPavadinimas, $nuotraukosIkelimas);
                                  $SQL_foto = "INSERT INTO `prekiu_nuotr` ( `prekės_id`, `status`)
                                                VALUES('$last_id', 1);";
                                  $ikeliamNuotrauka = mysqli_query(getPrisijungimas(), $SQL_foto);
                                      header("location: prekiu_valdymas.php?sekme=ikelta");
                                      exit();
                            } else {
                              header("location: prekiu_valdymas.php?sekme=dydis");
                              exit();
                            }
                      } else {
                          header("location: prekiu_valdymas.php?sekme=error");
                          exit();
                      }
                } else {
                    header("location: prekiu_valdymas.php?sekme=netinkamas");
                    exit();
                }
              }
?>

          </article>

      </section>

<?php include('footer.php'); ?>
