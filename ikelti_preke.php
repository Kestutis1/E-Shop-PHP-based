<?php
      include('header.php');
      include('db.php');
?>
      <section>

        <article class="">


        <h1>Administratoriaus puslapis</h1>


          <form id="dydis" class="" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="get">
                <label>Pasirinkti prekės dydį</label><br />
                    <select name="dydis">
                      <option value="S">S</option>
                      <option value="M">M</option>
                      <option value="L">L</option>
                      <option value="M">XL</option>
                      <option value="XXL">XXL</option>
                    </select><br />
                <button type="submit" name="Įkelti_dydi">Iįkelti</button>
            </form>


          <form id="spalva" class="" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="get">
                <label>Pasirinkti prekės spalva</label><br />
                    <select name="dydis">
                      <option value="Juoda">Juoda</option>
                      <option value="Balta">Balta</option>
                      <option value="Ruda">Ruda</option>
                    </select><br />

                <button type="submit" name="Įkelti_spalvą">Iįkelti</button>
            </form>



      <?php

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

              echo "<h3>Jūsų straipsnis sėkmingai įkeltas</h3>";
              header("Location: ikelti_preke.php?id=$last_id");

      }

      $id = $_GET['id'];
          echo $id;

      ?>

      </article>

      </section>

<?php include('footer.php'); ?>
