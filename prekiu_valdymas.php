<?php
      include('header.php');

      // IDEA: Pasitikrinam ar užėjo administrartorius jai ne siunčiam į index.php
      if ($_SESSION['u_uid'] != "Administratorius") {
            header("Location: index.php");
            exit();
        }

      $pre_pavadinimas = (isset($_GET['prePavadinimas']) == true) ?  $_GET['prePavadinimas'] : '';
      $pre_kaina = (isset($_GET['aprašymas']) == true) ?  $_GET['aprašymas'] : '';
      $pre_spalva = (isset($_GET['preSpalva']) == true) ?  $_GET['preSpalva'] : '';
      $pre_dydis = (isset($_GET['preDydis']) == true) ?  $_GET['preDydis'] : '';

?>


<section>

    <article>
          <div class="flex-container">
              <form name="ikelimas" id="ikelimas" method="post" action="foto.php" enctype="multipart/form-data">
                <label>Pasirinkti prekės kategoriją</label><br />
                    <select name="kategorija">
                      <option value="1">Marškinėliai</option>
                      <option value="2">Kepurės</option>
                      <option value="3">Batai</option>
                    </select><br />
                  <label>Prekės pavadinimas</label><br />
                      <input id="prePavadinimas" type="text" title="" name="prePavadinimas" value="<?php echo $pre_pavadinimas; ?>" autocomplete="on"><br />
                  <label>Spalva neprivalomas</label><br />
                      <input id="preSpalva" type="text" title="" name="preSpalva" value="<?php echo $pre_spalva; ?>" autocomplete="on"><br />
                  <label>Dydis neprivalomas</label><br />
                      <input id="preDydis" type="text" title="" name="preDydis" value="<?php echo $pre_dydis; ?>" autocomplete="on"><br />
                  <label>Prekės kaina</label><br />
                      <input id="preKaina" type="number" title="" name="preKaina" value="<?php echo $pre_kaina; ?>"><br />
                  <label>Prekės nuotrauka</label><br />
                      <input id="nuotrauka" type="file" title="" name="nuotrauka" style="display:none;">
                      <input type="button" id="loadFileXml" value="Pasirinkti nuotrauką" onclick="document.getElementById('nuotrauka').click();"/>
                  <label for="aprašymas">Prekės aprašymas</label><br/>
                      <textarea name="aprašymas" rows="8" cols="40"></textarea><br /><br />
                      <input class="mygtukas" type="submit" name="ĮkeltiPrekę" value="Įkelti">
              </form>
            </div>

<?php
        if (!isset($_GET['sekme'])) {
              exit();
        } else {
                  $signupCheck = $_GET['sekme'];
                  if ($signupCheck == "ikelta") {
                      echo "<script> if (document.getElementById('ikelimas')) {
                            document.getElementById('ikelimas').style.display = 'none';
                      } </script>";
                      echo "<h3 class='centre'>Jūsų prekė sėkmingai įkelta.</h3>";
                      exit();
                  }
                  elseif ($signupCheck == "dydis") {
                      echo "<p class='centre'>Jūsų nuotrauką užima perdaug vietos.</p>";
                      exit();
                  }
                  elseif ($signupCheck == "dydis") {
                      echo "<p class='centre'>Jūsų nuotrauką užima perdaug vietos. Ji turi būti nedidesnė 1000000 baitų.</p>";
                      exit();
                  }
                  elseif ($signupCheck == "error") {
                        echo "<p class='centre'>Įvyko error ikeliant jūsų nuotrauką.</p>";
                      exit();
                  }
                  elseif ($signupCheck == "netinkamas") {
                      echo "<p class='centre'>Jūsų pasirinkta nuotrauka yra netinkamo formato. Pasirinkite jpg, jpeg, png, aba pdf formatą.</p>";
                      exit();
                  }
                  elseif ($signupCheck == "defaultine") {
                      echo "<script> if (document.getElementById('ikelimas')) {
                          document.getElementById('ikelimas').style.display = 'none';
                    } </script>";
                      echo "<h3 class='centre'>Jūs nepasirinkote nuotraukos todėl prekei priskirta standartinė nuotrauka.</h3>";
                      exit();
                  }
        }
 ?>

          </article>

      </section>

<?php include('footer.php'); ?>
