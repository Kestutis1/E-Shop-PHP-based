<?php
      include('header.php');
      include('db.php');

?>


<section>

    <article class="">

        <h1>Administratoriaus puslapis</h1>



        <form class="" id="pre_sukurimas" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="get">
                <label>Pasirinkti prekės kategoriją</label><br />
                    <select name="kategorija" size="3">
                      <option value="1">Marškinėliai</option>
                      <option value="2">Kepurės</option>
                      <option value="3">Striukė</option>
                    </select><br />
                <label>Prekės pavadinimas</label><br />
                    <input id="pre_pavadinimas" type="text" title="" name="prePavadinimas" value="" required><br />
                <label>Prekės kaina</label><br />
                    <input id="pre_kaina" type="number" title="" name="preKaina" value=""><br />
                    <label for="aprašymas">Prekės aprašymas</label><br/>
                    <textarea name="aprašymas" rows="8" cols="40"></textarea><br /><br />
                <button type="submit" name="ĮkeltiPrekę">Iįkelti</button>
          </form>

<?php
// IDEA: Jaigu jau įkėlėm prekę į duombazę ir susigražinom jos id paslepiam prekįs įkėlimo formą.
        if(isset($_GET['id'])) {
              include_once('papil_pre_kategor.php');
              echo "<script> document.getElementById('pre_sukurimas').style.display = 'none'; </script>";
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
            // $spalva = mysqli_real_escape_string(getPrisijungimas(), $_GET['spalva']);
            // $dydis = mysqli_real_escape_string(getPrisijungimas(), $_GET['dydis']);
            $prePavadinimas = mysqli_real_escape_string(getPrisijungimas(), $_GET['prePavadinimas']);
            $preKaina = mysqli_real_escape_string(getPrisijungimas(), $_GET['preKaina']);
            $preAprašymas = mysqli_real_escape_string(getPrisijungimas(), $_GET['aprašymas']);



      // IDEA: Pradedam SQL ir kintaūjų įrašymą į duomenų bazę.
          $SQL = "INSERT INTO `prekes` (`id`, `kat_id`, `prekės_pavadinimas`, `prekės_kaina`, `prekės_aprašymas`)
                  VALUES (NULL, '$katId', '$prePavadinimas', '$preKaina', '$preAprašymas');";

          // $SQLdydis = "INSERT INTO `prekiu_dydis` (`prekės_id`, `prekės_dydis`)
          //         VALUES (NULL, '$dydis');";
          // $SQLspalva = "INSERT INTO `prekiu_spalvos` (`prekės_id`, `prekės_spalva`)
          //               VALUES (NULL, '$spalva');";
          $ikeliam = mysqli_query(getPrisijungimas(), $SQL);
          $last_id = mysqli_insert_id(getPrisijungimas());


          // $ikeliamSpalva = mysqli_query(getPrisijungimas(), $SQLspalva);
          // $ikeliamDydi = mysqli_query(getPrisijungimas(), $SQLdydis);

              echo "<h3>Jūsų prekė sėkmingai įkelta</h3>";
              header("Location: prekiu_valdymas.php?id=$last_id");
      }

?>

          </article>

      </section>

<?php include('footer.php'); ?>
