<?php
      include('header.php');
      include('db.php');

      $pre_pavadinimas = (isset($_GET['prePavadinimas']) == true) ?  $_GET['prePavadinimas'] : '';
      $pre_kaina = (isset($_GET['aprašymas']) == true) ?  $_GET['aprašymas'] : '';
?>


<section>

    <article>
          <div class="flex-container">
            <form class="" name="pre_ikelimas" id="pre_ikelimas" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="get">
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
                  <label for="aprašymas">Prekės aprašymas</label><br/>
                      <textarea name="aprašymas" rows="8" cols="40"></textarea><br /><br />
                      <input type="submit" name="ĮkeltiPrekę" value="Įkelti">
              </form>
            </div>
<?php
// IDEA: Jaigu jau įkėlėm prekę į duombazę ir susigražinom jos id paslepiam prekįs įkėlimo formą.
        if(isset($_GET['id'])) {
              include_once('papil_pre_kategor.php');
              echo "<script> document.getElementById('pre_ikelimas').style.display = 'none'; </script>";
            }


        // IDEA: Pradedu straipsnio įkėlimą į duombazę.

        function švarinamIvestis($data) {
              $data = trim($data);
              $data = stripslashes($data);
              $data = htmlspecialchars($data);
              return $data;
          }



      if(isset($_GET['ĮkeltiPrekę']))  {

      // IDEA: Susitvarkom kintamuosius.
            $katId = mysqli_real_escape_string(getPrisijungimas(), $_GET['kategorija']);
            $prePavadinimas = mysqli_real_escape_string(getPrisijungimas(), $_GET['prePavadinimas']);
            $preKaina = mysqli_real_escape_string(getPrisijungimas(), $_GET['preKaina']);
            $preAprašymas = mysqli_real_escape_string(getPrisijungimas(), $_GET['aprašymas']);



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
