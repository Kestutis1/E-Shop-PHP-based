<?php
include_once("header.php");
include_once("db.php");


if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string(getPrisijungimas(), $_POST['name']);
    $subject = mysqli_real_escape_string(getPrisijungimas(), $_POST['pavadinimas']);
    $mailFrom = mysqli_real_escape_string(getPrisijungimas(), $_POST['mail']);
    $message = mysqli_real_escape_string(getPrisijungimas(), $_POST['message']);

//IDEA: Ieškom error jai randam siunčiam į formos puslapį kintamajį.
    if (empty($name) || empty($subject) || empty($mailFrom) || empty($message)) {
          header("Location: kontaktai.php?mailsend=empty");
          exit();
    } else {
              if (!filter_var($mailFrom, FILTER_VALIDATE_EMAIL)) {
                header("Location: kontaktai.php?mailsend=email");
                exit();
             }
           }

// IDEA: Errorų nepasitaikė usirašom kintamuosius mail funkcijai.
    $mailTo = "djkestutis@yahoo.com";
    $headers = "From: ".$mailFrom;
    $txt = "Jūs gavote elektroninį laišką nuo ".$name.".\n\n".$message;

// IDEA: Siunčiam elektroninį laišką ir gražinam į kontaktų puslapį su kintamuoju.
    mail($mailTo, $subject, $txt, $headers);
    header("Location: kontaktai.php?mailsend=succes");
}
echo $txt;
include("footer.php");

 ?>
