console.log("Labas");

// IDEA: nusistatau registracijos formos laukų kintamuosius ir keičiu validacijos žinutę.
// IDEA: Susitvarkom registracijos-vardo validaciją.
if (document.getElementById("ivestiesVardas")) {
      var vardasIvestis = document.getElementById("ivestiesVardas");
      vardasIvestis.setCustomValidity("reikia užpildyti");

      // IDEA: Tikrinu vartotojo įvestis ir atitinkamai nustatau validaciją.



        vardasIvestis.oninvalid = function(event) {
           event.target.setCustomValidity("Vardas turi būti iš raidžių");
         }

        vardasIvestis.onchange = function(event) {
           event.target.setCustomValidity("");
         }


// IDEA: Ši funkcija užtikrina, kad be reikalo neiššokinėtų validacijos įspėjimo žinutė.

        vardasIvestis.oninput = function(event) {
           event.target.setCustomValidity("");
      }
}


// IDEA: Pakeičiu vardo pirmą raidę didžiają;

        function pakeiciamIdidziajaRaide() {
            var val = document.getElementById("ivestiesVardas").value;
            val = val.charAt(0).toUpperCase() + val.slice(1);
            document.getElementById("ivestiesVardas").value = val;
        }


// IDEA: pasilienku kitokio skripto pavyzdį(ne taip gerai suveikia).

// if (document.getElementById("pavar")) {
//       var pavardė= document.getElementById("pavar");
//       pavardė.setCustomValidity("reikia užpildyti");
//
//       pavardė.addEventListener("input", function (event) {
//         if (pavardė.validity.typeMismatch) {
//           pavardė.setCustomValidity("Čia reiktų įvesti savo vardą!");
//
//         } else {
//           pavardė.setCustomValidity("");
//         }
//         });
// }



// IDEA: Susitvarkom registracijos-pavardės validaciją.
if (document.getElementById("pavar")) {
      var registracijosPavar = document.getElementById("pavar");
      registracijosPavar.setCustomValidity("Pavardės laukelį reikia užpildyti");

      registracijosPavar.oninvalid = function (event) {
          event.target.setCustomValidity("Pavardės laukelis turi būti užpildytas raidžių simboliais");
      }

      registracijosPavar.oninput = function (event) {
          event.target.setCustomValidity("");
      }
}

// IDEA: Susitvarkom registracijos-elektroinio pašto validaciją.
if (document.getElementById("mail")) {
      var email = document.getElementById("mail");
      email.setCustomValidity("reikia užpildyti");

       email.oninvalid = function (event) {
           event.target.setCustomValidity("Elektroninis paštas turi turėti  @ simbolį ir simbolį .");
         }

      email.oninput = function (event) {
          event.target.setCustomValidity("");
      }
    }


// IDEA: Susitvarkom registracijos-telefono validaciją.
if (document.getElementById("tele")) {
      var telefonas = document.getElementById("tele");
      telefonas.setCustomValidity("reikia užpildyti");

      telefonas.oninvalid = function (event) {
          event.target.setCustomValidity("Telefono numeris turi būti iš skaičių!");
        }

// IDEA: Ši funkcija užtikrina, kad be reikalo neiššokinėtų validacijos įspėjimo žinutė.

      telefonas.oninput = function(event) {
          event.target.setCustomValidity("");
      }
}


// IDEA: Susitvarkom registracijos-slaptažodis1 validaciją.
if (document.getElementById("slapt")) {
      var slaptažodis1 = document.getElementById("slapt");
      slaptažodis1.setCustomValidity("reikia užpildyti");

      slaptažodis1.oninvalid = function (event) {
          event.target.setCustomValidity("Čia reikia įvesti slaptažodį.");
        }

          slaptažodis1.oninput = function (event) {
              event.target.setCustomValidity("");
       }
}

if (document.getElementById("pakartotSlap")) {
      var slaptažodis2 = document.getElementById("pakartotSlap");
      slaptažodis2.setCustomValidity("reikia užpildyti");

      slaptažodis2.oninvalid = function (event) {
          event.target.setCustomValidity("Čia reiktų pakartoti savo slaptažodį.");
        }

      slaptažodis2.oninput = function (event) {
          event.target.setCustomValidity("");
      }
 }


  // IDEA: pasitikrinu ar sutampa slaptažodžiai.
      function patikSlaptažodSutap() {
          if (slaptažodis1.value !== slaptažodis2.value) {
                slaptažodis2.setCustomValidity("Slaptažodžiai nesutampa!");
                return false;
          }
          else {
                return true;
          }
      }


 // IDEA: Pradedu prisijungimo formos laukų validaciją.
 // IDEA: Tikrinu prisijungimo-elapašto validaciją.

 if (document.getElementById("email")) {
        var elPastas = document.getElementById("email");

        elPastas.oninvalid = function (event) {
              event.target.setCustomValidity("Elektroninis paštas turi turėti  @ simbolį ir simbolį .");
        }

        elPastas .oninput = function (event) {
              event.target.setCustomValidity("");
        }
 }

 // IDEA: Tikrinu prisijungimo-slaptažodžio validaciją.
 if (document.getElementById("password")) {
        var prisijungtiSlaptažodis = document.getElementById("password");

        prisijungtiSlaptažodis.oninvalid = function (event) {
            event.target.setCustomValidity("Slaptažodį reikia įvesti teisingai norint prisijungti");
        }

        prisijungtiSlaptažodis.oninput = function (event) {
            event.target.setCustomValidity("");
        }
 }

// IDEA: Paslepiam straipsnio redagavimo formą
if (document.querySelector('#strRedagaForm')) {
        document.getElementById("strRedagaForm").style.display= "none";
}

// IDEA: Redaguojasi vartotojas savo straipsnį
function redaguotStr() {
    document.getElementById("straipsnis").style.display= "none";
    document.getElementById("strRedagaForm").style.display= "block";
}
