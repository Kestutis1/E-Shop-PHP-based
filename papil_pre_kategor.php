  <h2>Prekė sėkmingai įkelta galite <a href="index.php">grįžti į pagrindinį puslapį</a></h2><br />
  <h2>Galite papildomai įkelti prekės spalvą ir dydį. <button onclick="par_formas();">Įkelti</button></h2><br />

<?php
// IDEA: Prekės id
    $id = $_GET['id'];

?>

<form id="dydis" action="<?php echo htmlspecialchars('pre_spal_dyd.php');?>" method="get">
      <label>Pasirinkti prekės dydį</label><br />
            <select name="dydis">
              <option value="S">S</option>
              <option value="M">M</option>
              <option value="L">L</option>
              <option value="M">XL</option>
              <option value="XXL">XXL</option>
            </select><br />
            <input type="hidden" name="prekės_id" value="<?php echo $id; ?>">
        <label>Įrašyti prekės spalvą</label><br />
              <input type="text" name="spalva" value="">
            </select><br />
      <button type="submit" name="Įkelti">Iįkelti</button>
  </form>
