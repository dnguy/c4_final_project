
function retrieve_info_images(){
	$.ajax({
		url: 'index_page_load.php',
		dataType: 'json',
		method: 'POST',
		success: function(response){
			display_images(response);
			
		}
	});
};
function display_images(response){
	for(var i = 0; i < response.items.length; i++){
			var img_div = $('<div>').addClass('col-xs-2').attr({user_id: response.items[i].user_id, id: response.items[i].id, index_number: i});
			var img = $('<img>').attr('src', response.items[i].filepath);
			$(img_div).append(img);
			$('.item_container').append(img_div);

			$(img_div).click(function(){
				$('.modal-title').html('');
				$('.modal-body').html('');

				
				var modal_img = $('<img>').attr('src', response.items[$(this).attr('index_number')].filepath).addClass('modal_img');
				var extra_img_container = $('<div>').addClass('col-xs-12 extra_img_container');
				$.ajax({
					url:'item_image_handler.php',
					data:{postid: response.items[$(this).attr('index_number')].id},
					dataType: 'json',
					method: 'POST',
					success:function(data_image){
						window.data_image= data_image;
						console.log(data_image);
						for(var i = 0; i< data_image.images.length; i++){
							var extra_img = $('<img>').attr('src', data_image.images[i].filepath);
							$(extra_img_container).append(extra_img);
						}
					}
				});
				var title = $('<div>').text(response.items[$(this).attr('index_number')].title);
				var shoe_condition = $('<div>').text('Condition: ' + response.items[$(this).attr('index_number')].shoe_condition)
				var details = $('<div>').text('Details: ' + response.items[$(this).attr('index_number')].details);
				var size = $('<div>').text('size: ' + response.items[$(this).attr('index_number')].size);
				var price = $('<div>').text('$' + response.items[$(this).attr('index_number')].price);
				var contact_buyer_button = $('<button>').attr({type: 'submit', index_number: $(this).attr('index_number')}).text('Contact');
				var purchase_item_button = $('<button>').attr('type', 'submit').text('Purchase');
				var vote_priority_button = $('<i>').addClass('fa fa-thumbs-o-up fa-2x').attr('index_number', $(this).attr('index_number'));

				$(contact_buyer_button).click(function(){
					$('.modal-title').html('');
					$('.modal-body').html('');

					var subject= $('<input>').attr({placeholder: 'Subject', name:'subject'}).addClass('subject_input col-xs-8 col-xs-offset-2');
					var message= $('<textarea>').attr({placeholder: 'Message', name:'message'}).addClass('message_input col-xs-8 col-xs-offset-2');
					var submit_message_button = $('<button>').attr({type: 'submit',index_number: $(this).attr('index_number') }).addClass('col-xs-3 col-xs-offset-7').text('Send');

					$('.modal-title').html('Message');
					$('.modal-body').append(subject, message, submit_message_button);

					$(submit_message_button).click(function(){
						$.ajax({
							url: 'message_handler.php',
							dataType: 'json',
							data: {
								subject: $(subject).val(),
								message: $(message).val(),
								sender: response.email,
								postid: response.items[$(this).attr('index_number')].id,
							},
							method: 'POST',
							success: function(response){
								if(response.success){
									$('.modal-title').html('');
									$('.modal-body').html('');
									$('.modal-body').html('Your message has been sent!')
									$('#myModal').modal('show');
								}
								else if(!response.success){
								$('.alert').remove();
								var error_message = $('<div>').addClass('alert alert-danger col-xs-12').text(response.errors);
								$('.modal-body').append(error_message);
								}
							}
						});
					});
				});
				$(vote_priority_button).click(function(){
					$.ajax({
						url: 'vote_priority_handler.php',
						data: {
							user_id: response.id,
							post_id: response.items[$(this).attr('index_number')].id,
						},
						method: 'POST',
						dataType: 'json',
						success: function(response){
							if(response.success){
								console.log('item was liked');
								$('.alert').remove();
								var success_message = $('<div>').addClass('alert alert-success').text('Item was liked');
								$('.modal-body').append(success_message);
						
					}
							else if(!response.success){
								$('.alert').remove();
								var error_message = $('<div>').addClass('alert alert-danger').text(response.errors);
								$('.modal-body').append(error_message);
					}
						}
					});
				});

				$('.modal-title').html(title);
				$('.modal-body').append(modal_img,extra_img_container, shoe_condition, details, size, price, contact_buyer_button,purchase_item_button, vote_priority_button);
				$('#myModal').modal('show');

			});
		}
}


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
      var logout_button = $('<button>').attr('type', 'button').addClass('logout_button');
      var link_to_logout = $('<a>').attr('href','index.php?page=logout').text('Logout');
      var account_button = $('<button>').attr('type', 'button').addClass('account_button');
      var link_to_account = $('<a>').attr('href','index.php?page=account').text('Account');
      $(account_button).append(link_to_account);
      $(logout_button).append(link_to_logout);
      $(logout_button).click(function(){
        logout();
      });

      $('.logout_container').append(logout_button, account_button);

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
    	$('#status').html('');
      console.log('Successful login for: ' + response.name);
      var user_icon = $('<i>').addClass('fa fa-user fa-2x col-xs-2');
      var name_div = $('<div>').text(response.name).addClass('col-xs-8 user_name');
         $('#status').append(user_icon, name_div);
    });
  }
  function API_call(){
  FB.api('/me', function(response) {
    $.ajax({
    	url: 'login_handler.php',
    	data: {
    		first_name: response.first_name,
    		last_name:  response.last_name,
    		id: response.id,
    		email: response.email,
    	},
    	method: 'POST',
    	dataType: 'json',
    	success: function(response){
    		if(response.success){
    			console.log('account created');
    			$('.modal-body').text('Thank You for Logging in. A new account has been created for you. You can now start to posting shoes and contacting sellers!');
    			$('#myModal').modal('show');
    		}
    		else if(!response.success){
    			console.log('account already exists');
    		}
    	}
    });
});
};

function logout(){
   FB.logout(function(response) {
        $('.login_button').show();
        $('#status').html('');
        $('.logout_button').remove();
        $('.account_button').remove();
        statusChangeCallback(response);

    });
};


$(document).ready(function(){
	$('.brands > p').click(function(){
		$.ajax({
			url: 'brand_search_handler.php',
			data:{brand: $(this).html()},
			dataType: 'json',
			method: 'POST',
			success: function(response){
				$('.item_container').html('');
				console.log(response.items[0].brand);
				var brand_title = $('<div>').addClass('col-xs-12 brand_title').html(response.items[0].brand);
				$('.item_container').append(brand_title);
				display_images(response);

			}
		});
	});

});