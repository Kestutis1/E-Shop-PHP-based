<?php
session_start();
if (isset($_POST['submit'])){
    include("db.php");
     $uid = mysqli_real_escape_string(getPrisijungimas(), $_POST['uid']);
     $pwd = mysqli_real_escape_string(getPrisijungimas(), $_POST['pwd']);
     if (empty($uid) || empty($pwd)) {
         header("Location: login.php?login=empty");
         exit();
    } else {
    $sql = "SELECT * FROM users WHERE user_uid='$uid'";
    $result = mysqli_query(getPrisijungimas(), $sql);
    $resultCheck = mysqli_num_rows($result);
    if ($resultCheck < 1) {
      header("Location: login.php?login=error");
      exit();
  } else {
        if ($row = mysqli_fetch_assoc($result)) {
            $hashesPwdCheck = password_verify($pwd, $row['user_pwd']);
            if ($hashesPwdCheck == false) {
               header("Location: login.php?login=error");
               exit();
            } elseif ($hashesPwdCheck == true) {
               $_SESSION['u_id'] = $row['user_id'];
               $_SESSION['u_first'] = $row['user_first'];
               $_SESSION['u_last'] = $row['user_last'];
               $_SESSION['u_email'] = $row['user_email'];
               $_SESSION['u_uid'] = $row['user_uid'];
               header("Location: index.php?login=succes");
               exit();
            }
          }
        }
      }
} else {
    header("Location: login.php?login=error");
    exit();
}

 ?>
