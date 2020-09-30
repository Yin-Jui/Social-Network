/*
AJAX is a developer's dream, because you can:

Read data from a web server - after the page has loaded
Update a web page without reloading the page
Send data to a web server - in the background

*/
$(document).ready(function() {

	//Button for profile post
	$('#submit_profile_post').click(function(){
		
		$.ajax({
			type: "POST",
			url: "includes/handlers/ajax_submit_profile_post.php",
			data: $('form.profile_post').serialize(),
			success: function(msg) {
				$("#post_form").modal('hide');
				location.reload();
			},
			error: function() {
				alert('Failure');
			}
		});

	});


});