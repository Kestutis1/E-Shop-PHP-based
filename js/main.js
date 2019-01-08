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

$("#pre_ikelimas").validate({

    errorPlacement: function(error, element) {

        // name attrib of the field
		var n = element.attr("name");

		if (n == "prePavadinimas")
			element.attr("placeholder", "Prekės pavadinimą reikia įvesti");
		else if (n == "preKaina")
			element.attr("placeholder", "Prekės kainą reikia įvesti iš skaičių");
    },
    rules: {
        prePavadinimas: {
            minlength: 2,
            required: true
        },
        preKaina: {
            required: true,
            number: true
        }
    },
    highlight: function(element) {

        // add a class "has_error" to the element
        $(element).addClass('has_error');
    },
    unhighlight: function(element) {

        // remove the class "has_error" from the element
        $(element).removeClass('has_error');
    },
    submitHandler: function(form) {

       // submit form now.
    }
});
