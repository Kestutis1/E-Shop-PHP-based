<?php
    define('DB_NAME', "parduotuve");
    define('DB_USER', "root");
    define('DB_PASSWORD', "root");
    define('DB_HOST', "localhost");

$prisijungimas = mysqli_connect( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );
mysqli_set_charset($prisijungimas, 'utf8');

  function getPrisijungimas() {
      global  $prisijungimas;
      return  $prisijungimas;
  };

$rodytiŽinute = true;

if($prisijungimas && $rodytiŽinute){
  echo "<h4>Sėkmingai prisijungėme prie duomenų bazės</h4>";
} else {
  echo "<h4>Nepavyko prisijungti prie duomenų bazės</h4>";
}

// IDEA: funkcija skirta išvalyti formų įvestis.
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
