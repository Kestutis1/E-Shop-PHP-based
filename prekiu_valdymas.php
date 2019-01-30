<?php
      include('header.php');
      include('db.php');
      $pre_pavadinimas = (isset($_GET['prePavadinimas']) == true) ?  $_GET['prePavadinimas'] : '';
      $pre_kaina = (isset($_GET['aprašymas']) == true) ?  $_GET['aprašymas'] : '';
?>


<section>

    <article>
          <div class="flex-container">
            <form class="" name="ikelimas" id="ikelimas" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
                <label>Pasirinkti prekės kategoriją</label><br />
                    <select name="kategorija" size="3">
                      <option value="1">Marškinėliai</option>
                      <option value="2">Kepurės</option>
                      <option value="3">Striukė</option>
                    </select><br />
                  <label>Prekės pavadinimas</label><br />
                      <input id="prePavadinimas" type="text" title="" name="prePavadinimas" value="<?php echo $pre_pavadinimas; ?>" autocomplete="on"><br />
                  <label>Prekės kaina</label><br />
                      <input id="preKaina" type="number" title="" name="preKaina" value="<?php echo $pre_kaina; ?>"><br />
                  <label>Prekės nuotrauka</label><br />
                      <input id="nuotrauka" type="file" title="" name="nuotrauka"><br />
                  <label for="aprašymas">Prekės aprašymas</label><br/>
                      <textarea name="aprašymas" rows="8" cols="40"></textarea><br /><br />
                      <input type="submit" name="ĮkeltiPrekę" value="Įkelti">
              </form>
            </div>
<?php
// IDEA: Jaigu jau įkėlėm prekę į duombazę ir susigražinom jos id paslepiam prekįs įkėlimo formą.
        if(isset($_GET['id'])) {
              include_once('papil_pre_kategor.php');
              echo "<script> document.getElementById('ikelimas').style.display = 'none'; </script>";
            }


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

      // IDEA: Tikrinam nuotrauką ir jai viskas gerai įkeliam ją į nuotraukų papkę.
                if (in_array($nuotraukaActualExt, $allowed)) {
                      if ($nuotraukaError === 0) {
                            if ($nuotraukaSize > 1000000) {

                              // IDEA: keičiam nuotraukos pavadinimą į unikalų.
                                  $naujasNuotrPav = uniqid('', true).".".$nuotraukaActualExt;

                                  $nuotraukosIkelimas = 'img/'.$naujasNuotrPav;
                                  move_uploaded_file($nuotraukaTmpPavadinimas, $nuotraukosIkelimas);
                            } else {
                              echo "Jūsų nuotrauką užima perdaug vietos.";
                            }
                      } else {
                          echo "Įvyko error ikeliant jūsų nuotrauką.";
                      }
                } else {
                    echo "Jūs negalite įkelti prekei nuotraukos šio formato";
                }


      // IDEA: Pradedam SQL ir kintaūjų įrašymą į duomenų bazę.
          $SQL = "INSERT INTO `prekes` (`id`, `kat_id`, `prekės_pavadinimas`, `prekės_kaina`, `prekės_aprašymas`)
                  VALUES (NULL, '$katId', '$prePavadinimas', '$preKaina', '$preAprašymas');";
          $ikeliam = mysqli_query(getPrisijungimas(), $SQL);
          $last_id = mysqli_insert_id(getPrisijungimas());
              echo "<h3>Jūsų prekė sėkmingai įkelta</h3>";
              header("Location: prekiu_valdymas.php?id=$last_id");
      }
?>

          </article>

      </section>

<?php include('footer.php'); ?>
