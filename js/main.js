console.log("Labas");

// IDEA: Puslapiui papil_pre_kategor.php užsikrovus paslepiam prekės spalvoa ir dydžio formas.
if (document.getElementById("dydis")) {
      document.getElementById("dydis").style.display = "none";
}

if (document.getElementById("spalva")) {
      document.getElementById("spalva").style.display = "none";
}

// IDEA: Paspaudus mygtuką pridėti prekei spalvą ir dydį parodome formas
function par_formas () {
    document.getElementById("dydis").style.display = "block";
    document.getElementById("spalva").style.display = "block";
}

// IDEA: Susitvarkou prekių sukūrimo formos prekiu_valdymas.php įvesčių validaciją Prekės pavadinimas.
if (document.getElementById("pre_pavadinimas")) {
      var pre_pavadinimas = document.getElementById("pre_pavadinimas");
      pre_pavadinimas.setCustomValidity("Prekės pavadinimo laukelį reikia užpildyti");

      pre_pavadinimas.oninvalid = function (event) {
          event.target.setCustomValidity("Prekės pavadinimas turi būti užpildytas raidžių simboliais");
      }

      pre_pavadinimas.oninput = function (event) {
          event.target.setCustomValidity("");
      }
}
