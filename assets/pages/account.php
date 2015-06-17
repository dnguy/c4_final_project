<?php 
session_start();
?>
<div class="col-xs-10 col-xs-offset-1 sell_container">
<div class="col-xs-12"><h1>ACCOUNT<h1></div>
<div class="col-xs-12">
<?php 
print_r('Name : ' . $_SESSION['name']);
?>
</div>
<div class="col-xs-12">
<?php 
print_r('Email: ' . $_SESSION['email']);
?>
</div>
</div>