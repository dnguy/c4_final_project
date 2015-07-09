<?php
$pages= ['home'=>'assets/pages/home.php', 'messages'=>'assets/pages/messages.php','contact'=>'assets/pages/contact.php','search'=>'assets/pages/search.php', 'sell'=>'assets/pages/sell.php', 'account'=>'assets/pages/account.php','logout'=>'assets/pages/logout_handler.php']
?>
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

<div class="col-xs-7" id="status">
</div> 
<div class='col-xs-5 user_links'></div>
  </div>
      <div class="col-xs-12">
      <div class="col-xs-12"><h1 class="header_title">THE SNEAKER <br> CLOSET.</h1></div>
      <!-- <div class="col-xs-6"><input class="search_input" type="text" placeholder="Search"></div> -->
    </div>
    <div class="col-xs-12">
          <div class="navbar container">
            <button class="navbar-toggle" data-toggle="collapse" data-target=".navHeaderCollapse">
                <i class="fa fa-bars fa-2x"></i>
            </button>
            <div class="collapse navbar-collapse navHeaderCollapse navigation">
                <ul class="nav navbar-nav navigation_items">
                    <li><a href="index.php?page=home">HOME</a></li>
                    <li><a href="index.php?page=sell">SELL</a></li>
                    <li><a href="index.php?page=search">SEARCH</a></li>
                   <!--  <li><a href="#release_dates">RELEASE DATES</a></li> -->
                    <li><a href="index.php?page=contact">CONTACT US</a></li>
                </ul>
            </div>
        </div>
      </div>
	<div class="container">
  <div class="col-xs-12">
<input type='text' name='search' class="search_input col-xs-10 col-sm-4 col-sm-offset-4" placeholder="Search by shoe name">
<i class="fa fa-search col-xs-1 fa-2x search_button"></i>
</div>
<div class="col-xs-10 col-xs-offset-3 refine_search"></div>
    <section class='listing_page'>
        <?php
               if(!isset($_GET['page'])){
                $_GET['page']= 'home';
                include($pages[$_GET['page']]);
               }
               else {
               include_once($pages[$_GET['page']]);
           }
               ?>
    </section>
		<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body col-xs-12">
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