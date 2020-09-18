$(document).ready(function(){   // jquery can only be used when the page is ready

//On click signup, hide login and show registration form
	$("#signup").click(function(){     //. is for class, # is for id
		$("#first").slideUp("slow", function(){

			$("#second").slideDown("slow");
		});

	});

//On click signup, hide registration form and show login form
	$("#signin").click(function(){     //. is for class, # is for id
		$("#second").slideUp("slow", function(){

			$("#first").slideDown("slow");
		});

	});

});