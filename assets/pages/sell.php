<script>
	$(document).ready(function(){
		    $('.sell_link').css('color','black').css('font-weight','900');
		$('#file_upload').submit(function(e){
			var formData = new FormData($(this)[0]);
			$.ajax({
				url:'file_handler.php',
				type: 'POST',
				data: formData ,
				dataType: 'json',
				processData: false,
				contentType: false,
				success: function(data){
					if(data.success){
						console.log("data: ", data);
						$('.alert').remove();
						var success_message = $('<div>').addClass('alert alert-success').text('You item was uploaded');
						$('.modal-title').html('');
						$('.modal-body').html('');
						$('.modal-body').append(success_message);
						$('#myModal').modal('show');
						$('.title_input, .details_input , .size_input, .price_input, .location_input, .postal_code_input, .file_upload').val('');

					}
					if(!data.success){
						$('.alert').remove();
                        var error_message = $('<div>').addClass('alert alert-danger col-sm-12').text(data.errors);
                        $('.form_errors').append(error_message);
					}
				}
			});
			e.preventDefault();
		});

		$('.clear_button').click(function(){
			console.log('clear working');
			$('.title_input, .details_input , .size_input, .price_input, .location_input, .postal_code_input, .file_upload').val('');
		});
	});

</script>

<div class="col-xs-10 col-xs-offset-1 sell_container">
<div class='col-xs-12 sell_description'>
	<h1>Posting your shoes for sale is simple!</h1>
	<p><b>Step 1:</b> Make sure you are logged in</p>
	<p><b>Step 2:</b> Fill out all the fields below and be sure to include at least one photo</p>
	<p><b>Step 3:</b> Submit the form and check your account for your newly posted item</p>
</div>
<form enctype="multipart/form-data" id="file_upload">
<div class='form-group col-xs-12 col-sm-8 col-sm-offset-2'>
<input type="text" class="title_input form-control " name="title" placeholder="Title">
</div>
<div class='form-group col-xs-12 col-sm-8 col-sm-offset-2'>
<textarea type="text" class="details_input form-control" name="details" placeholder="Details"></textarea>
</div>
<div class='col-sm-8 col-sm-offset-2 form_container'>
<div class='form-group col-xs-12 col-sm-6'>
<select name="brand" class="form-control">
	<option value="nike">Nike</option>
	<option value="nike basketball">Nike Basketball</option>
	<option value="adidas">Adidas</option>
	<option value="jordan brand">Jordan Brand</option>
	<option value="new balance">New Balance</option>
	<option value="asics">Asics</option>
	<option value="reebok">Reebok</option>
	<option value="saucony">Saucony</option>
	<option value="vans">Vans</option>
	<option value="puma">Puma</option>
	<option value="others">Others</option>
</select>
</div>
<div class='form-group col-xs-12 col-sm-6'>
<select name="shoe_condition" class="form-control">
	<option value="brand-new">Brand New</option>
	<option value="pre-owned">Pre-owned</option>
</select>
</div>
</div>
<div class='col-sm-8 col-sm-offset-2 form_container'>
<div class='form-group col-xs-12 col-sm-6'>
<input type="text" class="size_input form-control" name="size" placeholder="Size">
</div>
<div class='form-group col-xs-12 col-sm-6'>
<input type="text" class="price_input form-control" name="price" placeholder="Price">
</div>
</div>
<div class='col-sm-8 col-sm-offset-2 form_container'>
<div class='form-group col-xs-12 col-sm-6'>
<input type="text" class="location_input form-control" name="location" placeholder="Location">
</div>
<div class='form-group col-xs-12 col-sm-6'>
<input type="text" class="postal_code_input form-control" name="postal_code" placeholder="Postal Code">
</div>
</div>
<div class='form-group col-xs-12 col-sm-6 col-sm-offset-3'>
<input type="file" class="file_upload form-control" name="fileToUpload[]" id="fileToUpload">
</div>
<div class='form-group col-xs-12 col-sm-6 col-sm-offset-3'>
<input type="file" class="file_upload form-control" name="fileToUpload[]" id="fileToUpload">
</div>
<div class='form-group col-xs-12 col-sm-6 col-sm-offset-3'>
<input type="file" class="file_upload form-control" name="fileToUpload[]" id="fileToUpload">
</div>
<div class='form-group col-xs-12 col-sm-6 col-sm-offset-3'>
<input type="file" class="file_upload form-control" name="fileToUpload[]" id="fileToUpload">
</div>
<div class='form-group col-xs-12 col-sm-6 col-sm-offset-3'>
<input type="file" class="file_upload form-control" name="fileToUpload[]" id="fileToUpload">
</div>
<div class='form-group col-xs-12 col-sm-6 col-sm-offset-3'>
<input type="file" class="file_upload form-control" name="fileToUpload[]" id="fileToUpload">
</div>
<div class="col-xs-12 form_errors"></div>
<input class="form_button col-xs-6 col-xs-offset-3 btn btn-default btn-success" type="submit" value="Submit" name="submit">
<button type="button" class="clear_button col-xs-6 col-xs-offset-3 btn btn-default btn-danger">Clear Form</button>
</form>

</div>