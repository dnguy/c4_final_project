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

	<div class="col-xs-12 top_header">
   <fb:login-button scope="public_profile,email" class="col-xs-1 login_button" onlogin="checkLoginState();">
</fb:login-button>

<div class="col-xs-3" id="status">
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
		<div class="col-xs-2">
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