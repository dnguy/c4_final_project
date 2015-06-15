<!DOCTYPE html>
<html>
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/style.css">
    <script src="assets/main.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
</head>
<body>
 <script>
 //      window.fbAsyncInit = function() {
 //        FB.init({
 //          appId      : 'your-app-id',
 //          xfbml      : true,
 //          version    : 'v2.3'
 //        });
 //      };

 //      (function(d, s, id){
 //         var js, fjs = d.getElementsByTagName(s)[0];
 //         if (d.getElementById(id)) {return;}
 //         js = d.createElement(s); js.id = id;
 //         js.src = "//connect.facebook.net/en_US/sdk.js";
 //         fjs.parentNode.insertBefore(js, fjs);
 //       }(document, 'script', 'facebook-jssdk'));
 //    </script>
    <script>
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
    console.log(JSON.stringify(response));
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
</script>


<!--
  Below we include the Login Button social plugin. This button uses
  the JavaScript SDK to present a graphical Login button that triggers
  the FB.login() function when clicked.
-->



	<div class="col-xs-12 top_header">
   <fb:login-button scope="public_profile,email" class="col-xs-1 login_button" onlogin="checkLoginState();">
</fb:login-button>

<div class="col-xs-2" id="status">
</div> 
<div class='logout_container'>
</div>
  </div>
	<div class="container">
		<div class="col-xs-12">
			<div class="col-xs-6"><h1>THE SNEAKER CLOSET.</h1></div>
			<div class="col-xs-6"><input class="search_input" type="text" placeholder="Search"></div>
		</div>
		<div class="col-xs-12 navigation">
			    <div class="navbar navbar-inverse">
        <div class="container">
            <button class="navbar-toggle" data-toggle="collapse" data-target=".navHeaderCollapse">
                <i class="fa fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse navHeaderCollapse">
                <ul class="nav navbar-nav navigation_items">
                    <li><a href="#home">HOME</a></li>
                    <li><a href="#about">BUY</a></li>
                    <li><a href="#skills">SELL</a></li>
                    <li><a href="#projects">RELEASE DATES</a></li>
                    <li><a href="#contact">CONTACT</a></li>
                </ul>
            </div>
        </div>
    	</div>
		</div>
		<div class="col-xs-3">
			<h3>BRANDS</h3>
			<p>Nike</p>
			<p>Adidas</p>
			<p>Jordan</p>
			<p>New Balance</p>
			<p>Asics</p>
			<p>Reebok</p>
			<p>Saucony</p>
			<p>Vans</p>
			<p>Nike Basketball</p>
			<p>Puma</p>
			<p>Others</p>
		</div>
		<div class="col-xs-9 item_container">
		</div>
		<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default close_button" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
	</div>
	</div>
	
</body>
</html>