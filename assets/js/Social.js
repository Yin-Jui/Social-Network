/*
AJAX is a developer's dream, because you can:

Read data from a web server - after the page has loaded
Update a web page without reloading the page
Send data to a web server - in the background

*/
$(document).ready(function() {

	$('#search_text_input').focus(function(){  //when click on text input of search box

		if(window.matchMedia("(min-width:800px)").matches){ //if the screen is large enough

			$(this).animate({width:'250px'}, 500);

		};

	$('.button_holder').on('click', function(){

		document.search_form.submit();
	});

	});

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

$(document).click(function(e){  //click on anyobject

	if(e.target.class != "search_results" && e.target.id != "search_text_input"){//search list disappear when clicking on other objects

		$(".search_results").html("");
		$('.search_results_footer').html("");
		$('.search_results_footer').toggleClass("search_results_footer_empty"); //toggle class: if it is hide, show it. if it is shown, hide it.
		$('.search_results_footer').toggleClass("search_results_footer");
	}

	if(e.target.class != "dropdown_data_window"){ //dropdown window, including notification and message disappear when clicking on other objects

	$(".dropdown_data_window").html("");
	$(".dropdown_data_window").css({"padding": "0px", "height" : "0px"});
	
	}

});

function getUser(value, user){
//send request to ajax_friend_search.php with query and userLoggedIn as parameters. When it returns, do function(data).
	$.post("includes/handlers/ajax_friend_search.php", {query:value, userLoggedIn:user}, function(data){
//data is what retured from ajax_friend_search.php
		$(".results").html(data);

	});
}
function getDropdownData(user, type) {

	if($(".dropdown_data_window").css("height") == "0px") { //dropdown menu is not showing.

		var pageName;

		if(type == 'notification') {
			pageName = "ajax_load_notifications.php";
			$("span").remove("#unread_notification");
		}
		else if (type == 'message') {
			pageName = "ajax_load_messages.php";
			$("span").remove("#unread_message");
		}

		var ajaxreq = $.ajax({
			url: "includes/handlers/" + pageName,
			type: "POST",
			data: "page=1&userLoggedIn=" + user,
			cache: false,

			success: function(response) {  //when return, do this function, show the data
				$(".dropdown_data_window").html(response);
				$(".dropdown_data_window").css({"padding" : "0px", "height": "200px", "border" : "1px solid #DADADA"});
				$("#dropdown_data_type").val(type);
			}

		});

	}
	else { //the dropdown window is already open.
		$(".dropdown_data_window").html("");
		$(".dropdown_data_window").css({"padding" : "0px", "height": "0px", "border" : "none"});
	}

}

function getLiveSearchUsers(value, user) {

	$.post("includes/handlers/ajax_search.php", {query:value, userLoggedIn: user}, function(data) {
//data is what returned from the ajax call.
		if($(".search_results_footer_empty")[0]) { //targeting this element
			$(".search_results_footer_empty").toggleClass("search_results_footer");
			$(".search_results_footer_empty").toggleClass("search_results_footer_empty");
		}

		$('.search_results').html(data);
		$('.search_results_footer').html("<a href='search.php?q=" + value + "'>See All Results</a>");

		if(data == "") {//if data is blank, not finding any result, remove all the elements
			$('.search_results_footer').html("");
			$('.search_results_footer').toggleClass("search_results_footer_empty"); //toggle class: if it is hide, show it. if it is shown, hide it.
			$('.search_results_footer').toggleClass("search_results_footer");
		}

	});

}