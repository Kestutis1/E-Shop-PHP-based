<?php
include("db.php");
include("header.php");

$signup = "";


if (isset($_POST['submit'])) {


      $first = mysqli_real_escape_string(getPrisijungimas(), $_POST['first']);
      $last = mysqli_real_escape_string(getPrisijungimas(), $_POST['last']);
      $email = mysqli_real_escape_string(getPrisijungimas(), $_POST['email']);
      $uid = mysqli_real_escape_string(getPrisijungimas(), $_POST['uid']);
      $pwd = mysqli_real_escape_string(getPrisijungimas(), $_POST['pwd']);

      // IDEA: Errorų tvarkymas jai tokių randam.
      if (empty($first) || empty($last) || empty($email) || empty($uid) || empty($pwd)) {
          $signup = "empty";
          // header("Location: signup.php?signup=empty");
     } else {
       // IDEA: Tikrinam leistinus simbolius Vardui ir Pavardei. Leidžiam tik LT raides.
           if (!preg_match("/^[-\pL&]+$/u", $first) || !preg_match("/^[-\pL&]+$/u", $last)) {
             $signup = "invalid";
          } else {
              if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                  $signup = "email";
              } else {
                  $sql = "SELECT * FROM users WHERE user_uid='$uid'";
                  $result = mysqli_query(getPrisijungimas(), $sql);
                  $resultCheck = mysqli_num_rows($result);

                  if ($resultCheck > 0) {
                        $signup = "usertaken";
                  } else {
                    // IDEA: Užkoduojam slaptažodį.
                      $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

                    // IDEA: Pradedam duomenų įrašymą į duombazę.
                      $sql = "INSERT INTO users (user_first, user_last, user_email, user_uid, user_pwd)
                       VALUES ('$first', '$last', '$email', '$uid', '$hashedPwd');";

                       mysqli_query(getPrisijungimas(), $sql);
                       header("Location: signup_succes.php?signup=succes");
                       exit();
                  }
              }
          }
       }
    }

// IDEA: Jaigu grįžtam pildyti formą tai formai išsisaugom vestas reikšmes.
$first = (isset($_POST['first']) == true) ?  $_POST['first'] : '';
$last = (isset($_POST['last']) == true) ?  $_POST['last'] : '';
$email = (isset($_POST['email']) == true) ?  $_POST['email'] : '';
$pwd = (isset($_POST['pwd']) == true) ?  $_POST['pwd'] : '';
$uid = (isset($_POST['uid']) == true) ?  $_POST['uid'] : '';

// IDEA: Jeigu iš skripto grįžo error arba jaigu sekmė.
    switch ($signup) {
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

?>

<section><article><div class = 'flex-container'>
<h1>Užsiregistruoti</h1>
<?php echo "$signup"; ?>

  <form class="plotis" action="" method="post">
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
