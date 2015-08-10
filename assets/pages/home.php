<script>
$(document).ready(function(){
  $('.home_link').css('color','black').css('font-weight','900');
	retrieve_info_images();
});
</script>
<div class="col-xs-12">
    <div class="input-group search_container col-xs-10 col-sm-6 col-sm-offset-3">
      <input type="text" name='search' class="form-control search_input" placeholder="Search by shoe name">
      <span class="input-group-btn">
        <button class="btn btn-default search_button" type="button">Search</button>
      </span>
    </div>
  </div>
<div class='col-xs-12'>
<div class="col-xs-10 col-sm-8 col-sm-offset-2 refine_search"></div>
</div>
	<div class="hidden-xs col-xs-1 brands">
      <h3>BRANDS</h3>
      <p class='nike'>Nike</p>
      <p>Nike Basketball</p>
      <p>Adidas</p>
      <p>Jordan Brand</p>
      <p>New Balance</p>
      <p>Asics</p>
      <p>Reebok</p>
      <p>Saucony</p>
      <p>Vans</p>
      <p>Puma</p>
      <p>Others</p>
    </div>
		<div class="col-xs-12 col-sm-10 col-sm-offset-1 item_container">
		</div>