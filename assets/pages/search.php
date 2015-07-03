<script>
	$(document).ready(function(){
		$('.search_button').click(function(){
			$.ajax({
				url: 'search_handler.php',
				data:{shoe_description: $('.search_input').val()},
				method:'POST',
				dataType: 'json',
				success:function(response){
					console.log($('.search_input').serialize());
					$('.item_container').html('');
					var search_title = $('<h4>').text('Search Results For: ' + response.title);
					$('.item_container').append(search_title);
					display_images(response);
					$('.refine_search').html('');
					var refine_search_title = $('<h4>').text('Refine Search');
					var refine_size_input = $('<input>').attr('placeholder', 'Size').addClass('refine_size_input');
					var refine_price_input = $('<input>').attr('placeholder', 'Max Price').addClass('refine_price_input');
					var refine_zipcode_input = $('<input>').attr('placeholder','Zip Code').addClass('refine_zipcode_input');
					var refine_zipcode_miles = $('<select>').addClass('miles').attr('name','miles').html('<option value="25">25 Miles</option><option value="50">50 Miles</option><option value="100">100 Miles</option>')
					var refine_button = $('<button>').attr({type: 'button'}).text('Search')
					$('.refine_search').append(refine_search_title, refine_size_input, refine_price_input, refine_zipcode_input,refine_zipcode_miles, refine_button);

					$(refine_button).click(function(){
						$.ajax({
							url: 'refine_size_handler.php',
							data: {size: $('.refine_size_input').val(), price: $('.refine_price_input').val(), zipcode: $('.refine_zipcode_input').val(), miles: $('.miles').val()},
							method: 'POST',
							dataType: 'json',
							success:function(response){
								$('.item_container').html('');
								var search_title_size = $('<h4>').text('Search Results For: ' + response.title);
								$('.item_container').append(search_title_size);
								display_images(response);
							}
						})
					});


				}

			});
		});
	});
</script>
<div class="col-xs-12">
<input type='text' name='search' class="search_input col-xs-10 col-sm-5 col-sm-offset-3" placeholder="Search by shoe name">
<i class="fa fa-search col-xs-1 fa-2x search_button"></i>
</div>
<div class="col-xs-1 refine_search"></div>
<div class="col-xs-12 col-sm-10 col-sm-offset-1 item_container">
</div>



