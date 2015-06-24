<script>
	$(document).ready(function(){
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
                        var error_message = $('<div>').addClass('alert alert-danger col-xs-12').text(data.errors);
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
<form enctype="multipart/form-data" id="file_upload">
<select name="brand" class="col-xs-6 col-xs-offset-3">
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
</select><br>
<input type="text" class="title_input col-xs-6 col-xs-offset-3" name="title" placeholder="Title">
<textarea type="text" class="details_input col-xs-6 col-xs-offset-3" name="details" placeholder="Details"></textarea>
<input type="text" class="size_input col-xs-6 col-xs-offset-3" name="size" placeholder="Size">
<input type="text" class="price_input col-xs-6 col-xs-offset-3" name="price" placeholder="Price">
<input type="text" class="location_input col-xs-6 col-xs-offset-3" name="location" placeholder="Location">
<input type="text" class="postal_code_input col-xs-6 col-xs-offset-3" name="postal_code" placeholder="Postal Code">
<select name="shoe_condition" class="col-xs-6 col-xs-offset-3">
	<option value="brand-new">Brand New</option>
	<option value="pre-owned">Pre-owned</option>
</select><br>
<input type="file" class="file_upload col-xs-6 col-xs-offset-3" name="fileToUpload[]" id="fileToUpload">
<input type="file" class="file_upload col-xs-6 col-xs-offset-3" name="fileToUpload[]" id="fileToUpload">
<input type="file" class="file_upload col-xs-6 col-xs-offset-3" name="fileToUpload[]" id="fileToUpload">
<input type="file" class="file_upload col-xs-6 col-xs-offset-3" name="fileToUpload[]" id="fileToUpload">
<input type="file" class="file_upload col-xs-6 col-xs-offset-3" name="fileToUpload[]" id="fileToUpload">
<input type="file" class="file_upload col-xs-6 col-xs-offset-3" name="fileToUpload[]" id="fileToUpload">
<div class="col-xs-12 form_errors"></div>
<input class="form_button col-xs-6 col-xs-offset-3" type="submit" value="Submit" name="submit">
<button type="button" class="clear_button col-xs-6 col-xs-offset-3">Clear Form</button>
</form>

</div>