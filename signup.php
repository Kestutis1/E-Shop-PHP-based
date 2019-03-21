<?php
include("db.php");
include("header.php");

$first = (isset($_POST['first']) == true) ?  $_POST['first'] : '';
$last = (isset($_POST['last']) == true) ?  $_POST['last'] : '';
$email = (isset($_POST['email']) == true) ?  $_POST['email'] : '';
$pwd = (isset($_POST['pwd']) == true) ?  $_POST['pwd'] : '';
$uid = (isset($_POST['uid']) == true) ?  $_POST['uid'] : '';

// IDEA: Jeigu iš skripto grįžo error arba jaigu sekmė.
  if (isset($_GET['sign'])) {
    switch ($_GET['sign']) {
      case 'empty':
          $signup = "Jūs užpildėte nevisus laukus !";
        break;
      case 'invalid':
          $signup = "Vardas ir Pavardė turi būti tik iš raidžių !";
        break;
      case 'email':
          $signup = "Tokio elektroninio pašto adreso nėra !";
        break;
      case 'usertaken':
          $signup = "Toks vartotojo vardas jau užimtas !";
        break;

      default:
        $signup = "";
        break;
    }
  } else {
    $signup = "";
  }
?>

<section><article><div class = 'flex-container'>
<h1>Užsiregistruoti</h1>
<?php echo "$signup"; ?>

  <form class="plotis" action="<?php echo htmlspecialchars('sign_script.php');?>" method="post">
    <input type="text" name="first" placeholder="Vardas" value="<?php echo $first; ?>">
    <input type="text" name="last" placeholder="Pavardė" value="<?php echo $last; ?>">
    <input type="text" name="email" placeholder=" E-paštas" value="<?php echo $email; ?>">
    <input type="text" name="uid" placeholder="Vartotojo vardas" value="<?php echo $pwd; ?>">
    <input type="password" name="pwd" placeholder="Slaptažodis" value="<?php echo $uid; ?>">
    <button type="submit" name="submit">Registruotis</button>
  </form>

</section></article></div>

<?php
include("footer.php");
?>
