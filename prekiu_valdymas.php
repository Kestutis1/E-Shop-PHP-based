<?php
      include('header.php');
      // include('db.php');
      include_once('includes\dbhinc.php');
      $pre_pavadinimas = (isset($_GET['prePavadinimas']) == true) ?  $_GET['prePavadinimas'] : '';
      $pre_kaina = (isset($_GET['aprašymas']) == true) ?  $_GET['aprašymas'] : '';


          $object = new Dbh;
          $object->connect();


?>


<section>

    <article>
          <div class="flex-container">
            <form class="" name="ikelimas" id="ikelimas" method="post" action="foto.php" enctype="multipart/form-data">
                <label>Pasirinkti prekės kategoriją</label><br />
                    <select name="kategorija">
                      <option value="1">Marškinėliai</option>
                      <option value="2">Kepurės</option>
                      <option value="3">Batai</option>
                    </select><br />
                  <label>Prekės pavadinimas</label><br />
                      <input id="prePavadinimas" type="text" title="" name="prePavadinimas" value="<?php echo $pre_pavadinimas; ?>" autocomplete="on"><br />
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


          </article>

      </section>

<?php include('footer.php'); ?>
