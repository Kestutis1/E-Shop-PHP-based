<?php
      include('header.php');
      include('db.php');

?>


<section>

    <article class="">

        <h1>Administratoriaus puslapis</h1>

        <?php
        // IDEA: Pasiimu prekės id kuriai pridėsiu spalvą arba dydį.
              $id = $_GET['prekės_id'];


        // IDEA: Pradedam dydžio į duombazės dydžio lentelę įrašymą.
                if (isset($_GET['Įkelti'])&&isset($_GET['dydis'])) {
                      $temp = test_input($_GET['dydis']);
                      $dydis = mysqli_real_escape_string(getPrisijungimas(), $temp);
        // IDEA: Pasiimu prekės id.


                    $SQL = "INSERT INTO prekiu_dydis(prekės_id, prekės_dydis) VALUES ('$id', '$dydis');";
                    $ikeliam = mysqli_query(getPrisijungimas(), $SQL);
                    if (!$ikeliam) {
                        echo "Nepavyko įkelti dydžio prekei. ";
                    } else {
                        echo "Sėkmingai įkėlėte dydį prekei. ";
                    }
                }
        // IDEA: Pradedam spalvos į duombazės dydžio lentelę įrašymą.
                if (isset($_GET['Įkelti'])&&($_GET['spalva'])!=NULL) {
                      $temp = test_input($_GET['spalva']);
                      $spalva = mysqli_real_escape_string(getPrisijungimas(), $temp);
        // IDEA: Pasiimu prekės id.


                    $SQL = "INSERT INTO prekiu_spalvos(prekės_id, prekės_spalva) VALUES ('$id', '$spalva');";
                    $ikeliam = mysqli_query(getPrisijungimas(), $SQL);
                    if (!$ikeliam) {
                        echo "Nepavyko įkelti spalvos prekei.";
                    } else {
                        echo "Sėkmingai įkėlėte spalvą prekei.";
                    }
                }

        ?>


          </article>

      </section>

<?php include('footer.php'); ?>
