var item_array = [];
var user_info = [];

function retrieve_info_images(){
	$.ajax({
		url: 'index_page_load.php',
		dataType: 'json',
		method: 'POST',
		success: function(response){
			item_array = response; 
			for(var i = 0; i < item_array.length; i++){
			var img_div = $('<div>').addClass('col-xs-3').attr({user_id: response[i].user_id, id: response[i].id, index_number: i});
			var img = $('<img>').attr('src', 'uploads/' + response[i].filepath);
			$(img_div).append(img);
			$('.item_container').append(img_div);

			$(img_div).click(function(){
				$('.modal-title').html('');
				$('.modal-body').html('');
				
				var modal_img = $('<img>').attr('src', 'uploads/' + item_array[$(this).attr('index_number')].filepath).addClass('modal_img');
				var title = $('<div>').text(item_array[$(this).attr('index_number')].title);
				var shoe_condition = $('<div>').text('Condition: ' + item_array[$(this).attr('index_number')].shoe_condition)
				var details = $('<div>').text(item_array[$(this).attr('index_number')].details);
				var size = $('<div>').text('size: ' + item_array[$(this).attr('index_number')].size);
				var price = $('<div>').text('$' + item_array[$(this).attr('index_number')].price);
				var contact_buyer_button = $('<button>').attr('type', 'submit').text('Contact');
				var vote_priority_button = $('<i>').addClass('fa fa-thumbs-o-up fa-2x').attr('index_number', $(this).attr('index_number'));

				$(vote_priority_button).click(function(){
					$.ajax({
						url: 'vote_priority_handler.php',
						data: {
							user_id: user_info.id,
							post_id: item_array[$(this).attr('index_number')].id,
						},
						method: 'POST',
						dataType: 'json',
						success: function(response){
							console.log(response);
							if(response.success){
								console.log('item was liked');
								$('.alert').remove();
								var success_message = $('<div>').addClass('alert alert-success').text('Item was liked');
								$('.modal-body').append(success_message);
						
					}
							else if(!response.success){
								$('.alert').remove();
								var error_message = $('<div>').addClass('alert alert-danger').text('Item was already liked');
								$('.modal-body').append(error_message);
					}
						}
					});
				});

				$('.modal-title').html(title);
				$('.modal-body').append(modal_img,shoe_condition, details, size, price, contact_buyer_button, vote_priority_button);
				$('#myModal').modal('show');

			});
		}
		}
	});
};

  // This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response) {
    window.response = response;
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
      testAPI();
      API_call();
      $('.login_button').hide();
      var logout_button = $('<button>').attr('type', 'button').addClass('logout_button').text('Logout');
      $(logout_button).click(function(){
        logout();
      });

      $('.logout_container').append(logout_button);

    } else if (response.status === 'not_authorized') {
      // The person is logged into Facebook, but not your app.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into this website.';
    } else {
      // The person is not logged into Facebook, so we're not sure if
      // they are logged into this app or not.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into Facebook.';
    }
  }

  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }

  window.fbAsyncInit = function() {
  FB.init({
    appId      : '1665864463643141',
    cookie     : true,  // enable cookies to allow the server to access 
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.2' // use version 2.2
  });

  // Now that we've initialized the JavaScript SDK, we call 
  // FB.getLoginStatus().  This function gets the state of the
  // person visiting this page and can return one of three states to
  // the callback you provide.  They can be:
  //
  // 1. Logged into your app ('connected')
  // 2. Logged into Facebook, but not your app ('not_authorized')
  // 3. Not logged into Facebook and can't tell if they are logged into
  //    your app or not.
  //
  // These three cases are handled in the callback function.

  FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
  });

  };

  // Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
  function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', function(response) {
      console.log('Successful login for: ' + response.name);
      document.getElementById('status').innerHTML =
        'Thanks for logging in, ' + response.name + '!';
    });
  }
  function API_call(){
  FB.api('/me', function(response) {
    user_info = response;
});
};

function logout(){
   FB.logout(function(response) {
        $('.login_button').show();
        $('#status').html('');
        $('.logout_button').remove();
        statusChangeCallback(response);
    });
};


$(document).ready(function(){
	retrieve_info_images();

});