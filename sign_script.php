<?php
if (isset($_POST['submit'])) {
   include_once("db.php");
      $first = mysqli_real_escape_string(getPrisijungimas(), $_POST['first']);
      $last = mysqli_real_escape_string(getPrisijungimas(), $_POST['last']);
      $email = mysqli_real_escape_string(getPrisijungimas(), $_POST['email']);
      $uid = mysqli_real_escape_string(getPrisijungimas(), $_POST['uid']);
      $pwd = mysqli_real_escape_string(getPrisijungimas(), $_POST['pwd']);

      // IDEA: Errorų tvarkymas jai tokių randam.
      if (empty($first) || empty($last) || empty($email) || empty($uid) || empty($pwd)) {
          header("Location: signup.php?signup=empty");
          exit();
     } else {
       // IDEA: Tikrinam leistinus simbolius Vardui ir Pavardei. Leidžiam tik LT raides.
           if (!preg_match("/^[-\pL&]+$/u", $first) || !preg_match("/^[-\pL&]+$/u", $last)) {
            header("Location: signup.php?signup=invalid");
             exit();
          } else {
              if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                  header("Location: signup.php?signup=email");
                  exit();
              } else {
                  $sql = "SELECT * FROM users WHERE user_uid='$uid'";
                  $result = mysqli_query(getPrisijungimas(), $sql);
                  $resultCheck = mysqli_num_rows($result);

                  if ($resultCheck > 0) {
                      header("Location: signup.php?signup=usertaken");
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

} else {
  header("Location: signup.php");
  exit();
}
